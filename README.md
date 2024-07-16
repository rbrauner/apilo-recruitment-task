# apilo-recruitment-task

Apilo recruitment task

## Task description

### Pierwszy krok zadania

Napisz w Symfony 6.x aplikację PHP OOP która na podstawie podanego pliku json zmapuje go klasy obiektu z metodami get/set (deserializacja).

- zasób API Inpost https://api-shipx-pl.easypack24.net/v1/points?city=Kozy
- wywoływanie przez CLI z wykorzystaniem Symfony command
- pierwszy argument - miasto (np. Kozy)
- do połączenia z API Inpostu skorzystaj z Symfony HTTP Client lub Guzzle
- dane zwracane
    - dump tablica obiektów
- deserializacja
    - wykorzystaj Symfony Serializer
    - serializer powinien przekształcić do modelu klasy następujące parametry:
        - count, page, totalPages
        - items[].name,
        - items[].address_details.*

**warunki techniczne**

- wykorzystanie OOP
- przewidzenie rozbudowy API o kolejne metody/mapowania
- nie wykorzystuj połączenia do bazy danych

### Drugi krok zadania

Bazując na powyższym zadaniu rozszerz aplikację o endpoint REST API.

- <ins>dane wejściowe:</ins> miasto, kod pocztowy
- <ins>walidacja:</ins>
    - miasto (min_3, max_64, wymagany),
    - kod pocztowy (preg_match, niewymagany)
- <ins>przekształcenie:</ins>
    - API Inpost wyświetla wyniki jeśli miasto jest podane w formacie Kozy . Dla KOZY i kozy nie zwraca wyników. Przekształć element wejściowy (np. KOZY lub kozy na Kozy)
- <ins>wynik:</ins>
    - przedstawia listę punktów odbioru
    - odpytanie API Inpost tylko po mieście, pole kod pocztowy ignorowane
    - pole / wartość:
        - id (pole z API name)
        - line1 (pole line1)
        - line2 (pole line2)
