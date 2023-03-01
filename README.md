## Patch Note Web Uygulaması  
Bu uygulama, kullanıcıların farklı sürümler arasındaki farkları takip edebilmesi için tasarlanmış bir patch note (yama notu) web uygulamasıdır. Uygulama, PHP Laravel framework'ü, JavaScript ve BootStrap kullanılarak geliştirilmiştir. Kolayca özelleştirilebilir bir yapıya sahiptir.

## Özellikler   
<ul style="font-size: smaller;">
  <li>Yeni sürümler için yama notları oluşturabilirsiniz.</li>
  <li>Her bir sürüm için değişiklikler, geliştirmeler ve düzeltmeler hakkında detaylı bilgi sağlanabilir.</li>
  <li>Kullanıcılar uygulamanın son sürümü hakkında bilgi alabilir ve indirebilir.</li>
</ul>    

## Kullanım
Uygulama, kullanımı kolay bir arayüze sahiptir. Yeni bir yama notu oluşturmak için, Patch Notunuzun tipini, açıklamasını, yayımlanma tarihini, var ise link ve tagını girin. Daha sonra, yama notunuz otomatik olarak Anasayfanızda en güncel tarihleri ile listelenir.

## Uygulamanın kurulumu oldukça basittir. Aşağıdaki adımları izleyerek hızlıca kurabilirsiniz
<ol>  
  <li>GitHub repo adresini terminalde çalıştırın: git clone <code>https://github.com/erhanakca/PatchNotes.git</code></li>
  <li>İndirilen klasörde, composer install komutunu çalıştırın. <code>composer install</code></li>
  <li>Gerekli npm komutlarını çalıştırın. <code>npm install & npm run dev</code></li>
  <li>.env.example dosyasını .env olarak kopyalayın ve ayarlarınızı yapın.</li>
  <li>php artisan key:generate komutunu çalıştırın.</li>
  <li>Veritabanınızı oluşturmak için php artisan migrate komutunu kullanın.</li>
</ol>

## Katkıda Bulunma
Katkıda bulunmak isteyen geliştiriciler, GitHub üzerinden pull request'ler oluşturarak projeye katkıda bulunabilirler.
<p>İNDEX<p>
<img src="https://user-images.githubusercontent.com/96442253/222019348-720df176-105b-4007-8829-2c2bf81c2d05.png" alt="İNDEX">
<p>CREATE<p>    
<img src="https://user-images.githubusercontent.com/96442253/222019428-a112c3aa-0ddd-480b-8759-3f61a0048701.png" alt"CREATE">
<p>UPDATE<p>    
<img src="https://user-images.githubusercontent.com/96442253/222019503-550a23b2-0cc9-4a1f-b12e-c7b72e7dadfc.png" alt="UPDATE">
