<h2>Patch Note Web Uygulaması<h2>
<br>    
<p>Bu uygulama, kullanıcıların farklı sürümler arasındaki farkları takip edebilmesi için tasarlanmış bir patch note (yama notu) web uygulamasıdır. Uygulama, Laravel PHP framework'ü kullanılarak geliştirilmiştir ve kolayca özelleştirilebilir bir yapıya sahiptir.</p>

<h2>Özellikler<h2> 
<br>    
<ul style="font-size: 5px;">
  <li>Yeni sürümler için yama notları oluşturabilirsiniz.</li>
  <li>Her bir sürüm için değişiklikler, geliştirmeler ve düzeltmeler hakkında detaylı bilgi sağlanabilir.</li>
  <li>Kullanıcılar uygulamanın son sürümü hakkında bilgi alabilir ve indirebilir.</li>
</ul>    

<h2>Kullanım</h2>
<br>
<p>Uygulama, kullanımı kolay bir arayüze sahiptir. Yeni bir yama notu oluşturmak için, sadece bir sürüm numarası, başlık ve açıklama girin. Daha sonra, yama notunuz otomatik olarak ana sayfada ve "Yama Notları" sayfasında listelenir.</p>

<h2 style="text-decoration: underline;">Kurulum</h2>
<h2 style="text-decoration: underline;">Uygulamanın kurulumu oldukça basittir. Aşağıdaki adımları izleyerek hızlıca kurabilirsiniz:</h2>
<ol>
  <li>GitHub repo adresini kopyalayın: https://github.com/kullaniciadi/repo-adi.git</li>
  <li>Kopyaladığınız adresi terminalde çalıştırın: git clone https://github.com/kullaniciadi/repo-adi.git</li>
  <li>İndirilen klasörde, composer install komutunu çalıştırın.</li>
  <li>.env.example dosyasını .env olarak kopyalayın ve ayarlarınızı yapın.</li>
  <li>php artisan key:generate komutunu çalıştırın.</li>
  <li>Veritabanınızı oluşturmak için php artisan migrate komutunu kullanın.</li>
</ol>

<h2 style="text-decoration: underline;">Katkıda Bulunma</h2>
<p>Katkıda bulunmak isteyen geliştiriciler, GitHub üzerinden pull request'ler oluşturarak projeye katkıda bulunabilirler.</p>
