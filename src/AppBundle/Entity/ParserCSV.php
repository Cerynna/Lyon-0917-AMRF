<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 29/12/17
 * Time: 03:44
 *
 *  *
 * DELETE THIS
 *
 */

namespace AppBundle\Entity;


class ParserCSV
{
    const MULTI_TASK = 0;

    const ONE_TASK_TIMER = 0.4;

    private $email;

    private $tel;

    private $status;

    private $commune;

    private $insee;

    private $zipCode;

    private $department;

    private $region;

    private $population;

    private $longitude;

    private $lattitude;

    private $theCSV;

    private $resultApiGouv;

    private $timerRequest;

    private $rowRequest;


    public function parseCSV($theCSV, $atRow, $timer)
    {

        $timestamp_debut = microtime(true);
        $this->setTheCSV($theCSV);
        $result = [];
        for ($i = 0; $i <= self::MULTI_TASK; $i++) {
            if (!empty($this->theCSV[$atRow + $i])) {

                $data = explode(',', $this->theCSV[$atRow + $i]);
                //$data[3] = str_pad($data[3], 5, 0, STR_PAD_LEFT);
                $data[0] = str_pad($data[0], 5, 0, STR_PAD_LEFT);
                $this->setResultApiGouv($data[0]);

                $ApiGouv = $this->getResultApiGouv();

                if (isset($ApiGouv[0]['nom'])) {
                    $this->setInsee($ApiGouv[0]['code']);
                    $this->setZipCode($ApiGouv[0]['codesPostaux'][0]);
                    $this->setStatus(true);

                    if (empty($data[1]) OR $data[1] == "\n"){
                        $this->setEmail($ApiGouv[0]['code'] ."@exemple.com" );
                        $result[$this->rowRequest]["nom"] = $i;
                        $result[$this->rowRequest]["insee"] = $data[0];
                        $result[$this->rowRequest]["erreur"] = "Aucun Email renseigné pour cet utilisateur";

                        $fp = fopen('ReportNOT.csv', 'a');
                        fputcsv($fp, $result[$this->rowRequest]);
                        fclose($fp);
                    } else {
                        $this->setEmail($data[1]);
                    }


                    $this->setCommune($ApiGouv[0]['nom']);
                    $this->setDepartment($ApiGouv[0]['codeDepartement']);
                    $this->setRegion($ApiGouv[0]['codeRegion']);
                    $this->setPopulation($ApiGouv[0]['population']);
                    $this->setLattitude($ApiGouv[0]['centre']['coordinates'][1]);
                    $this->setLongitude($ApiGouv[0]['centre']['coordinates'][0]);

                } else {
                    $this->setStatus(false);

                    $result[$this->rowRequest]["nom"] = $data[1];
                    $result[$this->rowRequest]["insee"] = $data[0];
                    $result[$this->rowRequest]["erreur"] = "Aucune correspondance avec la base de donnée du gouvernement";

                    $fp = fopen('ReportNOT.csv', 'a');
                    fputcsv($fp, $result[$this->rowRequest]);
                    fclose($fp);
                }
            }
            $this->setRowRequest($atRow + $i + 1);
        }

        $timestamp_fin = microtime(true);
        $difference_ms = $timestamp_fin - $timestamp_debut;
        $this->setTimerRequest($timer + round($difference_ms, 2));
        if ($atRow + $i <= $this->getMax()) {

            echo "Parser en cour d'execution<br />";
            $pourcent = ($atRow * 100) / $this->getMax();
            echo $atRow . " / " . $this->getMax() . " ";
            echo $this->getSchema($pourcent) . "<br />";
            echo "Temps estimé " . $this->getEstimeTime();
            echo "Temps passé " . round($timer / 60, 0) . " min";
            dump($atRow);


            return true;
        } else {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return ParserCSV
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param mixed $tel
     * @return ParserCSV
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return ParserCSV
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getCommune()
    {
        return $this->commune;
    }

    /**
     * @param mixed $commune
     * @return ParserCSV
     */
    public function setCommune($commune)
    {
        $this->commune = $commune;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInsee()
    {
        return $this->insee;
    }

    /**
     * @param mixed $insee
     * @return ParserCSV
     */
    public function setInsee($insee)
    {
        $this->insee = $insee;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param mixed $zipCode
     * @return ParserCSV
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param mixed $department
     * @return ParserCSV
     */
    public function setDepartment($department)
    {
        $this->department = $department;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     * @return ParserCSV
     */
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * @param mixed $population
     * @return ParserCSV
     */
    public function setPopulation($population)
    {
        $this->population = $population;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     * @return ParserCSV
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLattitude()
    {
        return $this->lattitude;
    }

    /**
     * @param mixed $lattitude
     * @return ParserCSV
     */
    public function setLattitude($lattitude)
    {
        $this->lattitude = $lattitude;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTheCSV()
    {
        return $this->theCSV;
    }

    /**
     * @param mixed $theCSV
     * @return ParserCSV
     */
    public function setTheCSV($theCSV)
    {
        $this->theCSV = file($theCSV);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResultApiGouv()
    {
        return $this->resultApiGouv;
    }

    /**
     * @param mixed $code
     * @return ParserCSV
     */
    public function setResultApiGouv($code)
    {
        $url = "https://geo.api.gouv.fr/communes?fields=code,nom,codesPostaux,codeDepartement,codeRegion,population,centre&code=" . $code;
        $this->resultApiGouv = json_decode(file_get_contents($url), true);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTimerRequest()
    {
        return $this->timerRequest;
    }

    /**
     * @param mixed $timerRequest
     * @return ParserCSV
     */
    public function setTimerRequest($timerRequest)
    {
        $this->timerRequest = $timerRequest;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRowRequest()
    {
        return $this->rowRequest;
    }

    /**
     * @param mixed $rowRequest
     * @return ParserCSV
     */
    public function setRowRequest($rowRequest)
    {
        $this->rowRequest = $rowRequest;
        return $this;
    }


    public function getMax()
    {
        return count($this->theCSV) - 1;
    }

    public function getEstimeTime()
    {
        $timeMin = ($this::ONE_TASK_TIMER * $this->getMax()) / 60;

        return round($timeMin) . " min";
    }


    public function getSchema($pourcent)
    {
        $result = "";
        for ($i = 0; $i <= 100; $i++) {
            if ($i <= $pourcent) {
                $result .= "█";
            } elseif ($i == round($pourcent, 0)) {
                $result .= "█>";
            } else {
                $result .= "░";
            }


        }
        $result .= " " . round($pourcent, 2) . "%";
        return $result;
    }


}