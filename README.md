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
  <li>GitHub repo adresini terminalde çalıştırın: git clone https://github.com/erhanakca/PatchNotes.git</li>
  <li>İndirilen klasörde, composer install komutunu çalıştırın. <code>composer install</code></li>
  <li>.env.example dosyasını .env olarak kopyalayın ve ayarlarınızı yapın.</li>
  <li>php artisan key:generate komutunu çalıştırın.</li>
  <li>Veritabanınızı oluşturmak için php artisan migrate komutunu kullanın.</li>
</ol>

## Katkıda Bulunma
Katkıda bulunmak isteyen geliştiriciler, GitHub üzerinden pull request'ler oluşturarak projeye katkıda bulunabilirler.
