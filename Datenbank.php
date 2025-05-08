<?php
class Datenbank
{
    private $host;
    private $user;
    private $datenbankname;
    private $passwort;
    public $conn;

    public function __construct()
    {
        $this->host = "localhost";
        $this->user = "root";
        $this->datenbankname = "game";
        $this->passwort = "";
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->datenbankname", $this->user, $this->passwort);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "" . $e->getMessage();
        }
    }

    // Getters() and Setters()

    public function savePlayer($player)
    {
        try {
            $name = $player->getName();
            $lebenspunkte = $player->getLebenspunkte();
            $angriffswert = $player->getAngriffswert();
            $sql = "INSERT INTO player (pname, lifepoints, attackvalue) VALUES ('$name', $lebenspunkte, $angriffswert)";
            $this->conn->exec($sql);
        } catch (PDOException $e) {
            echo "sql <br>" . $e->getMessage();
        }
    }

    public function loadPlayer()
    {
        try {
            $sql = "SELECT COUNT(*) FROM player";
            $stmt = $this->conn->query($sql);
            $count = $stmt->fetchColumn();

            if ($count == 0) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function checkPlayer($username)
    {
        $sql = "SELECT 1 FROM player WHERE pname = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['username' => $username]);

        if ($stmt->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public function extractData($playerName)
    {
        $sql = "SELECT pname, lifepoints, attackvalue FROM player WHERE pname = :playerName";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["playerName" => $playerName]);
        $playerData = $stmt->fetch();
        $data = [];
        if ($playerData) {
            $data["user"] = $playerData['pname'];
            $data["lifepoints"] = $playerData['lifepoints'];
            $data["attackvalue"] = $playerData["attackvalue"];
        }

        return $data;
    }

    public function saveFight($winner)
    {
        try {
            $sql = "INSERT INTO fight (winner) VALUES (:winner)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':winner' => $winner
            ]);
        } catch (PDOException $e) {
            echo "$sql <br>" . $e->getMessage();
        }
    }
}
