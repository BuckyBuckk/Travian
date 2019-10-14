<?php
class ResourceInfo{
    public static $woodcutter = array(
        array("wood","clay","iron","crop","consumption","constructionTime","cp","production"),
        array(40,100,50,60,2,272,1,7),
        array(65,165,85,100,1,620,1,13),
        array(110,280,140,165,1,1190,2,21),
        array(185,465,235,280,1,2100,2,31),
        array(310,780,390,465,1,3560,2,46),
        array(520,1300,650,780,2,5890,3,70),
        array(870,2170,1085,1300,2,9620,4,98),
        array(1450,3625,1810,2175,2,15590,4,140),
        array(2420,6050,3025,3630,2,25150,5,203),
        array(4040,10105,5050,6060,2,40440,6,280),
        array(6750,16870,8435,10125,2,64900,7,392),
        array(11270,28175,14090,16905,2,104050,9,525),
        array(18820,47055,23525,28230,2,166680,11,693),
        array(31430,78580,39290,47150,2,266880,13,889),
        array(52490,131230,65615,78740,2,427210,15,1120),
        array(87660,219155,109575,131490,3,683730,18,1400),
        array(146395,365985,182995,219590,3,1094170,22,1820),
        array(244480,611195,305600,366715,3,1750880,27,2240),
        array(408280,1020695,510350,612420,3,2801600,32,2800),
        array(681825,1704565,852280,1022740,3,4482770,38,3430)
    );
    public static $claypit = array(
        array("wood","clay","iron","crop","consumption","constructionTime","cp","production"),
        array(80,40,80,50,2,220,1,7),
        array(135,65,135,85,1,550,1,13),
        array(225,110,225,140,1,1080,2,21),
        array(375,185,375,235,1,1930,2,31),
        array(620,310,620,390,1,3290,2,46),
        array(1040,520,1040,650,2,5470,3,70),
        array(1735,870,1735,1085,2,8950,4,98),
        array(2900,1450,2900,1810,2,14520,4,140),
        array(4840,2420,4840,3025,2,23430,5,203),
        array(8080,4040,8080,5050,2,37690,6,280),
        array(13500,6750,135008435,2,37690,7,392),
        array(22540,11270,22540,14090,2,60510,9,525),
        array(37645,18820,37645,23525,2,97010,11,693),
        array(62865,31430,62865,39290,2,155420,13,889),
        array(104985,52490,104985,65615,2,248870,15,1120),
        array(175320,87660,175320,109575,3,398390,18,1400),
        array(292790,146395,292790,182995,3,637620,22,1820),
        array(488955,244480,488955,305600,3,1020390,27,2240),
        array(816555,408280,816555,510350,3,1632820,32,2800),
        array(1363650,681825,1363650,852280,3,2612710,38,3430)
    );
    public static $ironmine = array(
        array("wood","clay","iron","crop","consumption","constructionTime","cp","production"),
        array(100,80,30,60,3,150,1,7),
        array(165,135,50,100,2,920,1,13),
        array(280,225,85,165,2,1670,2,21),
        array(465,375,140,280,2,2880,2,31),
        array(780,620,235,465,2,4800,2,46),
        array(1300,1040,390,780,2,7860,3,70),
        array(2170,1735,650,1300,2,12810,4,98),
        array(3625,2900,1085,2175,2,20690,4,140),
        array(6050,4840,1815,3630,2,33310,5,203),
        array(10105,8080,3030,6060,2,53500,6,280),
        array(16870,13500,5060,10125,3,85800,7,392),
        array(28175,22540,8455,16905,3,137470,9,525),
        array(47055,37645,14115,28230,3,220160,11,693),
        array(78580,62865,23575,47150,3,352450,13,889),
        array(131230,104985,39370,78740,3,564120,15,1120),
        array(219155,175320,65745,131490,3,902790,18,1400),
        array(365985,292790,109795,219590,3,1444660,22,1820),
        array(611195,488955,183360,366715,3,2311660,27,2240),
        array(1020695,816555,306210,612420,3,3698850,32,2800),
        array(1704565,1363650,511370,1022740,3,5918370,38,3430)        
    );
    public static $cropland = array(
        array("wood","clay","iron","crop","consumption","constructionTime","cp","production"),
        array(70,90,70,20,0,150 ,1,7),
        array(115,150,115,35,0,440,1,13),
        array(195,250,195,55,0,900,2,21),
        array(325,420,325,95,0,1650,2,31),
        array(545,700,545,155,0,2830,2,46),
        array(910,1170,910,260,1,4730,3,70),
        array(1520,1950,1520,435,1,7420,4,98),
        array(2535,3260,2535,725,1,12640,4,140),
        array(4235,5445,4235,1210,1,20430,5,203),
        array(7070,9095,7070,2020,1,32880,6,280),
        array(11810,15185,11810,3375,1,52810,7,392),
        array(19725,25360,19725,5635,1,84700,9,525),
        array(32940,42350,32940,9410,1,135710,11,693),
        array(55005,70720,55005,15715,1,217340,13,889),
        array(91860,118105,91860,26245,1,347950,15,1120),
        array(153405,197240,153405,43830,2,556910,18,1400),
        array(256190,329385,256190,73195,2,891260,22,1820),
        array(427835,550075,427835,122240,2,1426210,27,2240),
        array(714485,918625,714485,204140,2,2282100,32,2800),
        array(1193195,1534105,1193195,340915,2,3651630,38,3430)
    );

    public static function getProduction($type,$level){
        if($type=="wood"){
            return self::$woodcutter[$level][7]*100;
        }
        else if($type=="clay"){
            return self::$claypit[$level][7]*100;
        }
        else if($type=="iron"){
            return self::$ironmine[$level][7]*100;
        }
        else if($type=="crop"){
            return self::$cropland[$level][7]*100;
        }
    }

    public static function getUpgradeReq($type,$level){
        if($type=="wood"){
            $woodRow=self::$woodcutter[$level];
            $upgradeReqs=array($woodRow[0], $woodRow[1], $woodRow[2], $woodRow[3], $woodRow[4], (int)$woodRow[5]/20);
            return $upgradeReqs;
        }
        else if($type=="clay"){
            $clayRow=self::$claypit[$level];
            $upgradeReqs=array($clayRow[0], $clayRow[1], $clayRow[2], $clayRow[3], $clayRow[4], (int)$clayRow[5]/20);
            return $upgradeReqs;
        }
        else if($type=="iron"){
            $ironRow=self::$ironmine[$level];
            $upgradeReqs=array($ironRow[0], $ironRow[1], $ironRow[2], $ironRow[3], $ironRow[4], (int)$ironRow[5]/20);
            return $upgradeReqs;
        }
        else if($type=="crop"){
            $cropRow=self::$cropland[$level];
            $upgradeReqs=array($cropRow[0], $cropRow[1], $cropRow[2], $cropRow[3], $cropRow[4], (int)$cropRow[5]/20);
            return $upgradeReqs;
        }
    }

    public static function getResFieldDesc($type){
        if($type=="wood"){
            return "Wood is produced here. By increasing its level you increase the production of wood.";
        }
        else if($type=="clay"){
            return "Clay is produced here. By increasing its level you increase the production of clay.";
        }
        else if($type=="iron"){
            return "Iron is produced here. By increasing its level you increase the production of iron.";
        }
        else if($type=="crop"){
            return "Crop is produced here. By increasing its level you increase the production of crop.";
        }
    }

}

?>