# alegeri.consiliulelevilor.com
alegeri.consiliulelevilor.com este aplicația internă ce se ocupă cu alegerile anuale pentru funcțiile celor din CNE.

# Instalare
Pentru development, se va folosi integral Laravel Homestead cu suita Vagrant + VirtualBox. În caz că nu ai idee cum să instalezi development environment-ul, vizitează pagina oficială Laravel Homestead unde ți se explică de ce software ai nevoie și cum îl poți instala.

1. Asigură-te că ai instalat dependencies-urile cu Composer:
```bash
$ composer install --ignore-platform-reqs
```

2. Fă-ți propriul tău fișier `Homestead.yml`:
```bash
$ vendor/bin/homestead make
```
În caz că ești pe Windows și  nu folosești GIT Bash, comanda este următoarea:
```bash
$ vendor\\bin\\homestead make
```

3. Asigură-te că propria configurație `Homestead.yml` din proiect arată cam așa:
```yaml
ip: 192.168.10.10
memory: 2048
cpus: 2
provider: virtualbox
authorize: ~/.ssh/id_rsa.pub
keys:
    - ~/.ssh/id_rsa
folders:
    -
        map: 'C:\Laravel\alegeri'
        to: /home/vagrant/code
sites:
    -
        map: alegeri.consiliulelevilor.test
        to: /home/vagrant/code/public
        type: "apache"
        php: "7.2"
        schedule: true
databases:
    - alegeri
name: alegeri
hostname: alegeri
```

4. În fișierul tău `hosts`, adaugă următoarea linie:
```
192.168.10.10 alegeri.consiliulelevilor.test
```
În felul ăsta, `alegeri.consiliulelevilor.test` va duce direct la serverul tău pe care îl vei porni.

5. Pornește Vagrant folosind comanda `up` cu opțiunea `--provision`:
```bash
$ vagrant up --provision
```
Va dura ceva, doar ai răbdare.

6. Când este gata, intră cu SSH în consolă și apoi du-te în `code/`, unde ai tot proiectul.
```bash
$ vagrant ssh
```
```bash
$ cd code/
```

7. Ia-ți propria configurație `.env`. În `.env` au loc toate variabilele ce ar trebui să fie protejate. Din această cauză, trebuie să ai propriile tale chei de access, de exemplu.
În caz că există chei de acces generale, doar cere-le. :)
```bash
$ cp .env.example .env
```

Apoi generează o cheie de criptare unică:
```bash
$ php artisan key:generate
```

8. Rulează migrările și seederii:
```bash
$ php artisan migrate --seed
```

9. Proiectul vine cu un server OAuth integrat, Laravel Passport. Asigură-te că instalezi cheile:
```bash
$ php artisan passport:install
```

10. Pentru final, fă asimilarea între folderele `storage` și `public`:
```bash
$ php artisan storage:link
```