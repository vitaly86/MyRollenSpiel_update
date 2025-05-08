<?php
session_start();
include "Spieler.php";
include "Datenbank.php";
class Kampf
{
    private $runden;
    private $arena;
    private $spieler1;
    private $spieler2;

    private $dt;

    private $user_db1;
    private $punkte_db1;
    private $angriff_db1;

    private $user_db2;
    private $punkte_db2;
    private $angriff_db2;

    public function __construct($spieler1, $spieler2)
    {
        $this->dt = new Datenbank();
        if ($spieler1 != null) {
            $first = $spieler1->getName();
            $punkte = $spieler1->getLebenspunkte();
            $angriff = $spieler1->getAngriffswert();
            $this->spieler1 = new Spieler($first, $punkte, $angriff);
            if (!$this->dt->checkPlayer($first)) {
                $this->dt->savePlayer($this->spieler1);
            }
            $this->user_db1 = $this->dt->extractData($first)["user"];
            $this->punkte_db1 = $this->dt->extractData($first)["lifepoints"];
            $this->angriff_db1 = $this->dt->extractData($first)["attackvalue"];
            $_SESSION["player1_data"] = [$this->user_db1, $this->punkte_db1, $this->angriff_db1];
        }
        if ($spieler2 != null) {
            $second = $spieler2->getName();
            $punkte = $spieler2->getLebenspunkte();
            $angriff = $spieler2->getAngriffswert();
            $this->spieler2 = new Spieler($second, $punkte, $angriff);
            if (!$this->dt->checkPlayer($second)) {
                $this->dt->savePlayer($this->spieler2);
            }
            $this->user_db2 = $this->dt->extractData($second)["user"];
            $this->punkte_db2 = $this->dt->extractData($second)["lifepoints"];
            $this->angriff_db2 = $this->dt->extractData($second)["attackvalue"];
            $_SESSION["player2_data"] = [$this->user_db2, $this->punkte_db2, $this->angriff_db2];
        }
        if ($spieler1 == null && $spieler2 == null) {
            $this->spieler1 = new Spieler("Player1", 100, 20);
            $this->spieler2 = new Spieler("Player2", 100, 30);
            if (!$this->dt->loadPlayer()) {
                $this->dt->savePlayer($this->spieler1);
                $this->dt->savePlayer($this->spieler2);
            }
        }
        if ($spieler1 == null && isset($_SESSION["player1_data"])) {
            list($this->user_db1, $this->punkte_db1, $this->angriff_db1) = $_SESSION["player1_data"];
        }
        if ($spieler2 == null && isset($_SESSION["player2_data"])) {
            list($this->user_db2, $this->punkte_db2, $this->angriff_db2) = $_SESSION["player2_data"];
        }
    }

    public function kampf()
    {
        $this->runden = 0;
        $round = 1;
        while ($this->punkte_db1 > 0 and $this->punkte_db2 > 0) {
            if ($this->runden % 2 == 0) {
                echo "<h2 class='round'>Round " . $round++ . "</h2>";
                $this->punkte_db2 -= $this->angriff_db1;
                if ($this->runden > 2) {
                    $this->angriff_db2 = mt_rand(10, 50);
                }
                if ($this->punkte_db2 < 0) {
                    $this->punkte_db2 = 0;
                }
                // sleep(1);
                echo "<h3>Player 2 remains $this->punkte_db2 Points </h3>";
            } else {
                $this->punkte_db1 -= $this->angriff_db2;
                if ($this->runden > 2) {
                    $this->angriff_db1 = mt_rand(10, 50);
                }
                if ($this->punkte_db1 < 0) {
                    $this->punkte_db1 = 0;
                }
                // sleep(1);
                echo "<h3>Player 1 remains $this->punkte_db1 Points</h3>";
            }
            $this->runden++;
            echo "<br>";
        }
        if ($this->punkte_db1 > 0) {
            echo "<h2>Player 1 won! </h2>";
            $this->dt->saveFight(1);
        } else {
            echo "<h2>Player 2 won! </h2>";
            $this->dt->saveFight(2);
        }
        echo "<h2>There are " . ceil($this->runden / 2) . " rounds</h2>";
    }
}
