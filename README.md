Prace nad frameworkiem wstrzymane ze względu na odkrycie YII framework :-)
Poniższa wersja dziala, jednak wymaga jeszcze dużo pracy.

PHP on RAGE

=====================

User manual - EN

WiP

=====================

Instrukcja obsugi - PL


Framework jest oparty o wzorzec projektowy MVC, natomiast odpowiednikiem generatora z rails jest plik
g.py odpowiadajacy za tworzenie controllerow, widokow, modeli z migracjami, badz calosciowo(czyli scaffolding).

Przyklad zastosowania:

> g.py  demo  mvc  neds  name:varchar(30):1:kowalski  wiek:int:0

1)g.py - nazwa skryptu generatora

2)demo - nazwa dla tworzonego widoku, modelu, kontrollera, lub wszystkiego razem

3)mvc - wybieramy, co chcemy stworzyć (m-model, v-view, c-controller), czyli możemy wybrać tylko np. "m"

4)neds - dodatkowe opcje dla widoku podobnie jak wyżej(new, edit, delete, show), ew. 0 czyli nic, dla statycznych stron

5)name:varchar(30):1:kowalski  - czyli pola tabeli w przypadku modelu:

  a)name - nazwa pola
    
  b)varchar(30) - typ danych
  
  c)0 może być null, 1 to NOT NULL
  
  d)kowalski - wartość domyślna (alternatywna)
  
6)Po utworzeniu modelu powinnismy w przegladarce odpalic: 
  www.nazwadomeny.com/migrate/ 

W ten sposob dokonana zostanie migracja tabel do bazy danych - przed migracja warto sprawdzic poprawnosc zapytan                  migracji znajdujacych sie w katalogu app/migrations/

7) plik konfiguracyjny bazy danych: app/dbconfig.php

8) wszystkie powstale pliki dla modeli, widokow, kontrolerow umieszczone sa w stosownych katalogach

9) wywolania www.nazwadomeny.com/name/show/id  www.nazwadomeny.com/name/edit/id  www.nazwadomeny.com/name/del/id

=========================================================================================================

Uwaga: Aktualna wersja Framewroka jest w fazie poczatkowej i nie przeznaczona do celow produkcyjnych.

=========================================================================================================

    Serdecznie zapraszam do wspolpracy nad Frameworkiem osoby znajace w stopniu zaawansowanym zagadnienia:
    OOP PHP, MVC, SQL, oraz SQL injection.
    Mile widziane osoby ze znajomoscia Rails, Python.
    
    Liczba wolnych miejsc 2.

