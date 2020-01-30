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
        array("name","attack","infDef","calDef","wood","clay","iron","crop","speed","capacity","consumption","trainTime"),
        array("Legionnaire",40,35,50,120,100,150,30,6,50,1,1600),
        array("Praetorian",30,65,35,100,130,160,70,5,20,1,1760),
        array("Imperian",70,40,25,150,160,210,80,7,50,1,1920),
        array("Equites Legati",0,20,10,140,160,20,40,16,0,2,1360),
        array("Equites Imperatoris",120,65,50,550,440,320,100,14,100,3,2640),
        array("Equites Caesaris",180,80,105,550,640,800,180,10,70,4,3520),
        array("Ram",60,30,75,900,360,500,70,4,0,3,4600),
        array("Fire Catapult",75,60,10,950,1350,600,90,3,0,6,9000),
        array("Senator",50,40,30,30750,27200,45000,37500,4,0,5,90700),
        array("Settler",0,80,80,5800,5300,7200,5500,5,3000,1,26900)
    );
    public static $gaulTroops = array(
        array("name","attack","infDef","calDef","wood","clay","iron","crop","speed","capacity","consumption","trainTime"),
        array("Phalanx",15,40,50,95,75,40,40,7,60,1,1040),
        array("Swordsmen",65,35,20,140,150,185,60,6,45,1,1440),
        array("Pathfinder",0,20,10,170,150,20,40,17,0,2,1360),
        array("Theutates Thunder",90,25,40,350,450,230,60,19,75,2,2480),
        array("Druidrider",45,115,55,360,330,280,120,16,35,2,2560),
        array("Haeduan",140,60,165,500,620,675,170,13,65,3,3120),
        array("Ram",50,30,105,950,555,330,75,4,0,3,5000),
        array("Trebuchet",70,45,10,960,1450,630,90,3,0,6,9000),
        array("Chieftain",40,50,50,30750,45400,31000,37500,5,0,4,90700),
        array("Settler",0,80,80,4400,5600,4200,3900,5,3000,1,22700)
    );
    public static $natarTroops = array(
        array("name","attack","infDef","calDef","wood","clay","iron","crop","speed","capacity","consumption","trainTime"),

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

    public static function getTroopAttPoins($tribe,$troopID){
        if($tribe=="teuton"){
            return self::$teutonTroops[$troopID][1];
        }
        if($tribe=="roman"){
            return self::$romanTroops[$troopID][1];
        }
        if($tribe=="gaul"){
            return self::$gaulTroops[$troopID][1];
        }
        if($tribe=="natar"){
            return self::$natarTroops[$troopID][1];
        }
    }
    
    public static function getTroopDefPoins($tribe,$troopID){
        if($tribe=="teuton"){
            return array(self::$teutonTroops[$troopID][2],self::$teutonTroops[$troopID][3]);
        }
        if($tribe=="roman"){
            return array(self::$romanTroops[$troopID][2],self::$romanTroops[$troopID][3]);
        }
        if($tribe=="gaul"){
            return array(self::$gaulTroops[$troopID][2],self::$gaulTroops[$troopID][3]);
        }
        if($tribe=="natar"){
            return array(self::$natarTroops[$troopID][2],self::$natarTroops[$troopID][3]);
        }
    }
}

?>