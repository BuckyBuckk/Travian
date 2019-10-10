<?php
class ResourceInfo{
    public static $woodcutter = array(
        array("level","lumber","clay","iron","crop","consumption","constructionTime","cp","production"),
        array(1,40,100,50,60,2,272,1,7),
        array(2,65,165,85,100,1,620,1,13),
        array(3,110,280,140,165,1,1190,2,21)
    );
    public static $claypit = array(
        array("level","lumber","clay","iron","crop","consumption","constructionTime","cp","production"),
        array(1,80,40,80,50,2,272,1,7),
        array(2,135,65,135,85,1,620,1,13),
        array(3,225,110,225,140,1,1190,2,21)
    );
    public static $ironmine = array(
        array("level","lumber","clay","iron","crop","consumption","constructionTime","cp","production"),
        array(1,100,80,30,60,3,272,1,7),
        array(2,165,135,50,100,2,620,1,13),
        array(3,280,225,85,165,2,1190,2,21)
    );
    public static $cropland = array(
        array("level","lumber","clay","iron","crop","consumption","constructionTime","cp","production"),
        array(1,70,90,70,20,0,272,1,7),
        array(2,115,150,115,35,0,620,1,13),
        array(3,195,250,195,55,0,1190,2,21)
    );

    public static function getProduction($type,$level){
        if($type=="wood"){
            return self::$woodcutter[$level][8];
        }
        if($type=="clay"){
            return self::$claypit[$level][8];
        }
        if($type=="iron"){
            return self::$ironmine[$level][8];
        }
        if($type=="crop"){
            return self::$cropland[$level][8];
        }
    }
}

?>