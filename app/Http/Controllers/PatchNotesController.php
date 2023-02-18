<?php

namespace App\Http\Controllers;

use App\Constants\PatchNotesConstant;
use App\Http\Repositories\Eloquent\PatchNoteLinkRepository;
use App\Http\Repositories\Eloquent\PatchNoteRepository;
use App\Http\Repositories\Eloquent\PatchNoteTagRepository;
use App\Http\Repositories\Eloquent\TagRepository;
use App\Http\Requests\PatchNoteRequest;
use App\Models\PatchNote;
use App\Models\PatchNoteLink;
use App\Models\PatchNoteTags;
use App\Models\Tag;
use Exception;
use Faker\Provider\ka_GE\Text;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Constant;

class PatchNotesController extends Controller
{
    protected PatchNoteRepository $patchNoteRepository;
    protected PatchNoteLinkRepository $patchNoteLinkRepository;
    protected TagRepository $tagRepository;
    protected PatchNoteTagRepository $patchNoteTagRepository;

    public function __construct(PatchNoteRepository $patchNoteRepository, PatchNoteLinkRepository $patchNoteLinkRepository, TagRepository $tagRepository, PatchNoteTagRepository $patchNoteTagRepository)
    {
        $this->patchNoteRepository = $patchNoteRepository;

        $this->patchNoteLinkRepository = $patchNoteLinkRepository;

        $this->tagRepository = $tagRepository;

        $this->patchNoteTagRepository = $patchNoteTagRepository;
    }

    public function index()
    {
        try {
            $tag = Tag::all();
            $patch_note = PatchNote::whereIn('type', [0,1])
                ->orderBy('date', 'desc')
                ->with('patchNoteTags')
                ->get();
            foreach ($patch_note as $item){
                $patch_note_id = $item->patch_note_id;
                $patch_note_link = PatchNoteLink::where('patch_note_id', $patch_note_id)->get();
                $item->links = $patch_note_link;

                $tags = $item->patchNoteTags;
                $tag_names = [];
                foreach ($tags as $patch_note_tags) {
                    $tag_names[] = $patch_note_tags->name;
                }
                $item->tags = $tag_names;
            }
        }catch (\Exception $e){
            return response(['success' => false, 'error' => $e->getMessage()]);
        }

        return view('/index', ['tag' => $tag, 'patch_note' => $patch_note]);
    }

    public function dateFilter()
    {
        try {
            $tag = Tag::all();
            $patch_note = PatchNote::where('date', '=', $_GET)
                ->orderBy('date', 'desc')
                ->get();
        }catch (\Exception $e){
            return response(['success' => false, 'error' => $e->getMessage()]);
        }

        return view('/index', ['tag' => $tag, 'patch_note' => $patch_note]);
    }

    // TODO: henüz bitmedi yapılacak.
    public function tagFilter()
    {
        try {
            $tagNames = explode(' ', request('tags'));
            $tagIds = Tag::whereIn('name', $tagNames)->pluck('tag_id');

            $data = PatchNote::with('patchNoteTags')
                ->whereHas('patchNoteTags', function ($q) use ($tagIds){
                    $q->whereIn('patch_note_tags.tag_id', $tagIds);
                })

                ->orderBy('date', 'desc')
                ->get();

        }catch (\Exception $e){
            return response(['success' => false, 'error' => $e->getMessage()]);
        }

        return view('/index', ['patch_note' => $data]);
    }

    public function create(PatchNoteRequest $patchNoteRequest)
    {
        try {
            $data = $patchNoteRequest->validated();
            $type = match ($data['type']) {
                'BUG_FIX' => PatchNotesConstant::BUG_FIX,
                'NEW_PATCH' => PatchNotesConstant::NEW_PATCH,
                default => "Unknown Type"
            };
            $patchNote = $this->patchNoteRepository->create([
                'type' => $type,
                'text' => $data['text'],
                'date' => $data['date']
            ]);

            $links = explode(' ', $data['link']);
            foreach ($links as $link){
                $this->patchNoteLinkRepository->create([
                    'patch_note_id' => $patchNote['patch_note_id'],
                    'link' => $link
                ]);
            }

            $tags = explode(' ', $data['tag']);
            foreach ($tags as $tag){
                $tag = str_replace("#", "", $tag);
                $existingTag = $this->tagRepository->findByName($tag);
                if ($existingTag){
                    $this->patchNoteTagRepository->create([
                        'patch_note_id' => $patchNote['patch_note_id'],
                        'tag_id' => $existingTag['tag_id']
                    ]);
                } else {
                    $newTag = $this->tagRepository->create([
                        'name' => $tag
                    ]);
                    $this->patchNoteTagRepository->create([
                        'patch_note_id' => $patchNote['patch_note_id'],
                        'tag_id' => $newTag['tag_id']
                    ]);
                }
            }
            return redirect(route('index'));
        }catch (\Exception $e){
            return response(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function update(PatchNoteRequest $patchNoteRequest, $id)
    {
        try {
            $patch_note_id = $this->patchNoteRepository->find($id);
            $data = $patchNoteRequest->validated();
            $type = match ($data['type']){
                'NEW_PATCH' => PatchNotesConstant::NEW_PATCH,
                'BUG_FIX' => PatchNotesConstant::BUG_FIX,
                default => "Unknown Type"
            };

           $patch_note = $this->patchNoteRepository->update($id, [
               'type' => $type,
               'text' => $data['text'],
               'date' => $data['date']
           ]);

           $patch_note_id->patchNoteLink()->delete();


           if (!empty($data['link'])) {
               $create = explode(' ', $data['link']);
               foreach ($create as $link) {
                   $this->patchNoteLinkRepository->create([
                       'patch_note_id' => $patch_note['patch_note_id'],
                       'link' => $link
                   ]);
               }
           }else{
               return redirect(route('index'));
           }

            return redirect(route('index'));

        }catch (\Exception $e){
            return response(['success' => false, 'error' => $e->getMessage()]);
        }

    }

    public function delete($id)
    {
        try {
            $patch_note = PatchNote::with('patchNoteLink')->find($id);
            $patch_note->patchNoteLink()->delete();
            $patch_note->delete();
            return redirect(route('index'));
        }catch (\Exception $e) {
            return response(['success' => false, 'error' => $e->getMessage()]);
        }
    }




}


