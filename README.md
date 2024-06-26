# iTechTracker 

## Installationsanleitung MAMP/XAMPP
Damit die App iTechTracker auf einem neuen System deployed werden kann, müssen folgende Anforderungen erfüllt werden:
* MySQL Server
* Webserver
* Git Unterstützung
---
### 1. Server starten
Als ersten Schritt muss die ganze Serverumgebung gestartet werden. Dazu MAMP/XAMPP öffnen und Starten:
* MAMP
    * Server starten
* XAMPP
    * Apache starten
    * MySQL starten

---
### 2. Git Clone
Nun kann das Projekt von GitHub über folgenden Link heruntergeladen werden. Der Steicherort merken, da dieser anschliessend benötigt wird.

````
git clone https://github.com/mgasche/iTechTracker.git
````
---
### 3. DB importieren & Rechte zuweisen
Jetzt muss die vorkonfigurierte DB auf den DB Server installiert werden. Dazu das zur Verfügung gestellte mysql Script itechtracker.sql verwenden. Dieses kann direkt in phpmyadmin Webinterface ausgeführt werden. <br>
Anschliessend wird die DB mit dem Demoinhalt importiert.

Damit die Applikation anschliessend auch Zugriff hat, muss ein User mit folgenden Rechten auf die DB erstellt werden:
* Insert
* Update
* Delete
* Select

In der demo Konfig wurden Folgende Angaben verwendet:


````
CREATE USER 'itechtracker'@'localhost' IDENTIFIED BY 'TrvM]s9(SwNzls_A';
````

````
GRANT SELECT, INSERT, UPDATE, DELETE ON 'itechtracker'.* TO 'itechtracker@'localhost';
````

Es ist empfohlen dies in einer produktiven Umgebung zu ändern. Dann muss auch das dbconnector.php File entsprechend angepasst werden.

---
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

---
### 5. Webseite aufrufen
Jetzt ist alles konfiguriert und die Webseite kann in Betrieb genommen werden. Über folgenden Link kann die Seite aufgerufen werden.
````
http://localhost
````
Die Demodaten wurden mit folgenden Usern erstellt:
````
Username: itechtracker-demo
Password: iTechTracker-Demo1
````
````
Username: itechtracker-demo2
Password: iTechTracker-Demo2
````