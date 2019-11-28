<?php
class TroopInfo{
    public static $teutonTroops = array(
        array("name","attack","infDef","calDef","wood","clay","iron","crop","speed","capacity","consumption","trainTime"),
        array("Macemen",40,20,5,95,75,40,40,7,60,1,1000),
        array("Spearman",10,35,60,145,70,85,40,7,40,1,1120),
        array("Axeman",60,30,30,130,120,170,70,6,50,1,1200),
        array("Scout",0,10,5,160,100,50,50,9,0,1,1120),
        array("Paladin",55,100,40,370,270,290,75,10,110,2,2400),
        array("Teutonic Knight",150,50,75,450,515,480,80,9,80,3,2960),
        array("Ram",65,30,80,1000,300,350,70,4,0,3,4200),
        array("Catapult",50,60,10,900,1200,600,60,3,0,6,9000),
        array("Chief",40,60,40,35500,26600,25000,27200,4,0,4,70500),
        array("Settler",10,80,80,5800,4400,4600,5200,5,3000,1,31000)
    );
    public static $romanTroops = array(
        array("name","attack","infDef","calDef","wood","clay","iron","crop","speed","capacity","consumption","trainTime")
    );
    public static $gaulTroops = array(
        array("name","attack","infDef","calDef","wood","clay","iron","crop","speed","capacity","consumption","trainTime")
    );
    public static $natarTroops = array(
        array("name","attack","infDef","calDef","wood","clay","iron","crop","speed","capacity","consumption","trainTime")
    );

    public static function getTrainCost($tribe,$troopID){
        if($tribe == "teuton"){
            $troopRow = self::$teutonTroops[$troopID];
            $trainCost = array($troopRow[4], $troopRow[5], $troopRow[6], $troopRow[7]);
            return $trainCost;
        }
        else if($tribe == "roman"){
            $troopRow = self::$romanTroops[$troopID];
            $trainCost = array($troopRow[4], $troopRow[5], $troopRow[6], $troopRow[7]);
            return $trainCost;
        }
        else if($tribe == "gaul"){
            $troopRow = self::$gaulTroops[$troopID];
            $trainCost = array($troopRow[4], $troopRow[5], $troopRow[6], $troopRow[7]);
            return $trainCost;
        }
        else if($tribe == "natar"){
            $troopRow = self::$natarTroops[$troopID];
            $trainCost = array($troopRow[4], $troopRow[5], $troopRow[6], $troopRow[7]);
            return $trainCost;
        }
    }

    public static function getTrainTime($tribe,$troopID){
        if($tribe=="teuton"){
            return self::$teutonTroops[$troopID][11]/100;
        }
        else if($tribe=="roman"){
            return self::$romanTroops[$troopID][11]/100;
        }
        else if($tribe=="gaul"){
            return self::$gaulTroops[$troopID][11]/100;
        }
        else if($tribe=="natar"){
            return self::$natarTroops[$troopID][11]/100;
        }
    }
    
    public static function getTroopName($tribe,$troopID){
        if($tribe=="teuton"){
            return self::$teutonTroops[$troopID][0];
        }
        else if($tribe=="roman"){
            return self::$romanTroops[$troopID][0];
        }
        else if($tribe=="gaul"){
            return self::$gaulTroops[$troopID][0];
        }
        else if($tribe=="natar"){
            return self::$natarTroops[$troopID][0];
        }
    }

    public static function getSlowestTroopSpeed($tribe,$troopIDs){
        if(count($troopIDs) && $tribe){
            if($tribe=="teuton"){
                $troopSpeeds = [];
                foreach ($troopIDs as $troopID){
                    array_push($troopSpeeds, self::$teutonTroops[$troopID][8]);
                }

                return min($troopSpeeds);
            }
            else if($tribe=="roman"){
                $troopSpeeds = [];
                foreach ($troopIDs as $troopID){
                    array_push($troopSpeeds, self::$romanTroops[$troopID][8]);
                }

                return min($troopSpeeds);
            }
            else if($tribe=="gaul"){
                $troopSpeeds = [];
                foreach ($troopIDs as $troopID){
                    array_push($troopSpeeds, self::$gaulTroops[$troopID][8]);
                }

                return min($troopSpeeds);
            }
            else if($tribe=="natar"){
                $troopSpeeds = [];
                foreach ($troopIDs as $troopID){
                    array_push($troopSpeeds, self::$natarTroops[$troopID][8]);
                }

                return min($troopSpeeds);
            }
        }
    }
}

?>