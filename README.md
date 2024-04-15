# iTechTracker 

## Installationsanleitung MAMP/XAMPP
Damit die App iTechTracker auf einem neuen System deployed werden kann, müssen folgende Anforderungen erfüllt werden:
* MySQL Server
* Webserver
* Git Unterstützung

### 1. Server starten
Als ersten Schritt muss die ganze Serverumgebung gestartet werden. Dazu MAMP/XAMPP öffnen und Starten:
* MAMP
    * Server starten
* XAMPP
    * Apache starten
    * MySQL starten

### 2. DB importieren
Jetzt muss die vorkonfigurierte DB auf den DB Server installiert werden. Dazu das zur Verfügung gestellte mysql Script verwenden. Dieses kann direkt in phpmyadmin ausgeführt werden. <br>
Anschliessend wird die DB, der DB User und Demoinhalt importiert.

### 3. Git Clone
Nun kann das Projekt von GitHub über folgenden Link heruntergeladen werden. Der Steicherort merken, da dieser anschliessend benötigt wird.

### 4. Webroot anpassen
Damit die Webseite direkt mittels eingabe http://localhost aufgerufen werdne kann, muss der Webserver unkonfigueriert werden. Dazu zuerst den Webserver Dienst in XAMPP oder der Server in MAMP stoppen.

#### 4.1 MAMP
Im MAMP Controllpanel kann über Preferences -> Register Server den Document Root angepasst werden. <br>
Hier kann der Entsprechende Orfner im Finder gesucht werden.

#### 4.2 XAMPP
Dazu das httpd.conf File über XAMPP öffnen und folgende beiden Zeilen bearbeiten.
Der Pfad jeweils auf das Root verzeichnis des Projekts setzen. Hier ein Beispiel mit dem Ordner im C:\Temp\iTechTracker. Dieser kann bei Ihnen abweichen.
````
DocumentRoot "C:\Temp\iTechTracker"
<Directory "C:\Temp\iTechTracker">
````

Anschliessend kann der jeweilige Server wieder gestartet werden.

### 5. Webseite aufrufen
Jetzt ist alles konfiguriert und die Webseite kann in Betrieb genommen werden. Über folgenden Link kann die Seite aufgerufen werden.
````
http://localhost
````
Die Demodaten wurden mit folgendem User erstellt:
````
Username: itechtracker-demo
Password: iTechTracker-Demo1
````