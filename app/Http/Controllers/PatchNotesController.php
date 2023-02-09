<?php

namespace App\Http\Controllers;

use App\Constants\PatchNotesConstant;
use App\Http\Repositories\Eloquent\PatchNoteLinkRepository;
use App\Http\Repositories\Eloquent\PatchNoteRepository;
use App\Http\Repositories\Eloquent\PatchNoteTagRepository;
use App\Http\Repositories\Eloquent\TagRepository;
use App\Http\Requests\PatchNoteRequest;
use App\Models\PatchNote;
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
        $tag = Tag::all();
        $patch_note = PatchNote::whereIn('type', [0,1])
            ->orderBy('date', 'desc')
            ->get();


        return view('/index', ['tag' => $tag], ['patch_note' => $patch_note]);
    }

    public function dateFilter()
    {
        $tag = Tag::all();
        $patch_note = PatchNote::whereIn('type', [0,1])
            ->where('date', '=', $_GET)
            ->orderBy('date', 'desc')
            ->get();

        return view('/index', ['tag' => $tag], ['patch_note' => $patch_note]);
    }

    // TODO: henüz bitmedi yapılacak.
    public function tagFilter()
    {
        $tagNames = request('tags', []);
        $tagIds = Tag::whereIn('name', $tagNames)->pluck('tag_id');

        $data = PatchNote::whereHas('patchNoteTags', function($query) use($tagIds) {
            $query->whereIn('tag_id', $tagIds);
        })->with(['patch_note_tags', 'tags'])
            ->orderBy('date', 'desc')
            ->get();

        return view('/index', ['patch_note' => $data]);
    }

    public function create(PatchNoteRequest $patchNoteRequest)
    {
        try {
            $data = $patchNoteRequest->validated();
            $type = match ($data['type']) {
                'NEW_PATCH' => PatchNotesConstant::NEW_PATCH,
                'BUG_FIX' => PatchNotesConstant::BUG_FIX,
            };
            $patchNote = $this->patchNoteRepository->create([
                'type' => $type,
                'text' => $data['text'],
                'date' => $data['date']
            ]);

            $this->patchNoteLinkRepository->create([
                'patch_note_id' => $patchNote['patch_note_id'],
                'link' => $data['link']
            ]);

            $tags = explode(',', $data['tag']);
            foreach ($tags as $tag){
                $existingTag = $this->tagRepository->findByName($tag);
                if ($existingTag){
                    $this->patchNoteTagRepository->create([
                        'patch_note_id' => $patchNote['patch_note_id'],
                        'tag_id' => $existingTag->id
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
            return response(['success' => false, 'error' => $e->getMessage()], 404,);
        }
    }




}























