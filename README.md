ISS Finder
=======
Zadanie rekrutacyjne:
-------
    Zadanie:
    Stwórz prostą stronę internetową pokazującą użytkownikowi w jakiej części świata znajduje
    się obecnie Stacja Kosmiczna ISS.
    
    Dla przykładu wiadomość może brzmieć: "Obecna pozycja stacji ISS to Kgalagadi North
    District, Botswana". Ostateczny wygląd zależy od Ciebie.
    
    Uwagi:
    * http://wheretheiss.at/w/developer​ API z informacjami o obecnej pozycji ISS
    * Możesz użyć Google's Geocoding API​ lub jakiego kolwiek innego systemu do
    geocodingu w celu przetłumaczenia geolokalizacji na "ludzki język"
    https://developers.google.com/maps/documentation/geocoding/intro#ReverseGeocoding
    
    Technika:
    * PHP - czysty, bez frameworków (wersja min 5.6)
    * aplikacja w oparciu o zasady SOLID
    * OOP i MVC
    * możesz skorzystać z zewnętrznych bibliotek lub użyć czystego CURL'a do komunikacji z API
    
    * nie skupiaj się na wizualnym aspekcie a na funkcjonalności i architekturze aplikacji
    lecz na tym by zastosować najlepsze znane Ci praktyki
    Powodzenia!

Środowisko uruchomieniowe:
-------
Wymagane:
 - Apache 2.4.25
     - z włączonym rozszerzeniem 'mod_rewrite'
     - w pliku konfiguracyjnym wskazującym na folder z projektem - włączona opcja 'AllowOverride All' 
 - PHP 7.1
 - połączenie z internetem
 
Opcjonalnie:
 - Composer
 
Aplikacja startuje w pliku ;index.php;, ale nie potrzeba podawać nazwy,
.htaccess przekieruje ściezki np. '/' i '/nazwa-strony' na ten plik automatycznie
 
Użyte zewnętrzne biblioteki (importowane przez Composer):
-------
- guzzlehttp/guzzle: 6.2.x
    > użyty do komunikacji z REST API Google'a oraz WhereTheIss.at

Opis:
-------
Z góry zaznaczam, że zgodnie z zadaniem nie używałem żadnego gotowego frameworka 
(tak jakby kogoś zmyliła struktura folderów).
Technika miała być OOP + MVC, więc oczywiście rozdzieliłem te warstwy od siebie
i tak powstał mały "framework", z którego korzysta aplikacja.

Utworzyłem też dwa kontrolery (dwie podstrony)
- wyszukiwanie pozycji ISS
- kontakt
aby pokazać działanie Routingu.

Korzystam tutaj z dobrodziejstw PSR-4 przy ładowaniu klas z użyciem przestrzeni nazw.
Starałem sie też utrzymywać standard formatowania kodu PSR-2(extended).

Aby utrzymywać obiekty w miarę "odseparowane" od siebie użyłem wzorca projektowego
Dependency Injection oraz IoC kontenera, za pomocą którego dostarcza się instancji innych obiektów

Do połączeń z API użyłem biblioteki Guzzle, ponieważ jest ona łatwa do zastąpienia
w testach jednostkowych, posiada gamę klas obudowujących żądania, wyjątków 
i nie zmusza nas do niskopoziomowych operacji na łańcuchach znaków
oraz stałych jak w przypadku cURL'a

Jest też możliwość definiowania własnych obiektów Listener'a, np. do wyłapywania wyjątków.
Jeden z nich zdefiniowałem jako ExceptionListener i można sprawdzić jego działanie
uruchamiając np. zły URL do nieistniejącej strony 'dddd' np. 'http://ściezkaDoProjektu/dddd'

Z ważnych rzeczy dot. zadania zauważyłem, że oba API, które zostały użyte nie podają nam 
informacji na temat adresu i strefy czasowej, gdy stacja ISS znajduje się poza lądem (np. nad oceanem),
więc i to obsłużyłem, aby użytkownik też miał tego świadomość.

Przy okazji wyświetlana jest też mapka z Google Maps z aktualną pozycją ISS.

Struktura folderów/obiektów i ich role
-------
Assets
> Przechowywane są tutaj tzw. zasoby aplikacji w postaci obrazków, plików CSS i JS

Configuration
> Znajdują się tutaj pliki w formacie JSON (dla przykładu), w których przechowywane 
są dane konfiguracyjne:
 
> config.json: adresy URL do API, klucze dostępu      

> routes.json: łączenie ścieżek URL z odpowiedniki kontrolerami i metodami 
(ich nazwy bez Controller i Action - są automatycznie dopisywane przy sprawdzaniu ścieżek)
    
Controllers
> Tutaj są kontrolery, obsługujące żądanie, mający wbudowane metody do generowania widoków
oraz odpytywania kontenera DependencyInjection

Engine:
> tzw. jądro "frameworka", znajdują się tutaj wszystkie klasy i interfejsy, które sterują
przepływem sterowania, zawiera też m.in
> - routing - obsługa żądań i uruchamianie kontrolerów
> - IoC kontener
> - config - w postaci singletonu, który ładuje przy starcie aplikacji pliki configuracyjne.
 Może również ładować dodatkowe pliki użytkownika/aplikacji (jest taka możliwość)
> - Http - klasy przechowujące żądanie i odpowiedź HTTP
> - listenery - wbudowane listenery wewnątrz silnika
> - interfejsy i klasy do użycia wzorca Obserwatora
> - View - Generatory widoków
> - Initializer'y - klasy inicjujące cały framework
> - DTO(Data Transfer Object) - budowniczy, który dostając surowe obiekty \stdClass tworzy odpowiednie do nich klasy
z zawartością pobraną z surowego obiektu (np. od API), wykorzystuje on rekurencję
oraz mechanizm refleksji do wykrywania argumentów setterów w modelach DTO

Models:
> znajdują się tutaj modele DTO jako odpowiedniki obiektów JSON dla Google API i WhereTheIss.at
te modele używane są w aplikacji, przechowują one dane modelowe

Resolvers:
> znajdują się tutaj klasy zdefiniowane przez aplikację (nie framework),
które korzystając z kontenera IoC rozwiązują zależności
(odpowiednik dla wewnętrznych obiektów frameworka 
znajduje się w Engine\Dependency\Resolvers\EngineDependencyResolver)

Services:
> tutaj znajdują się obiekty przechowywujące i realizujące logikę biznesową aplikacji
w tym przypadku są to wzorce Adaptera łączacego się z API - obudowywujące je,
oraz klasy dostarczające odpowiednie dane do aplikacji (przekazane póżniej w kontrolerach do widoków)

vendor:
> folder z zewnętrznymi zależnościami i bibliotekami załadowanymi przez Composer

Views:
> Zaimplementowany jest też tutaj prosty mechanizm szabloków/widoków,
w tym folderze znajdują się pliki widoków z rozszerzeniem .php używe w aplikacji
(dla frameworka sa osobne widoki zdefiniowane w Engine\Views)
