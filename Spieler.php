<?php 
class Spieler {
    private $name;
    private $lebenspunkte;
    private $angriffswert;
    private $erstellungsdatum;

    public function __construct($name, $lebenspunkte, $angriffswert){
        $this->name = $name;
        $this->lebenspunkte = $lebenspunkte;
        $this->angriffswert = $angriffswert;
    }

    public function getName(){
        return $this->name;
    }

    public function getLebenspunkte(){
        return $this->lebenspunkte;
    }

    public function getAngriffswert(){
        return $this->angriffswert;
    }

    public function getDatum(){
     return $this->erstellungsdatum;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setLebenspunkte($lebenspunkte){
        $this->lebenspunkte = $lebenspunkte;
    }

    public function setAngriffswert($angriffswert){
        $this->angriffswert = $angriffswert;
    }

    public function setDatum($erstellungsdatum){
        $this->erstellungsdatum = new DateTime($erstellungsdatum);
    }

    public function zeigeStatus(){
        echo "Mein aktuell Status ist $this->lebenspunkte <br>";
    }

    public function hatGeburtstag($heute){
        $date = new DateTime($heute);
        $diff = $date->diff($this->erstellungsdatum);
        echo "Die tage seit Erstellung = $diff->days <br>";
        if($date->format('m-d') === $this->erstellungsdatum->format('m-d')){
            echo "Der Spieler hat heute Geburtstag <br>";
        }else{
            echo "Heute ist kein Geburtstag <br>";
        }
    }
}
?>