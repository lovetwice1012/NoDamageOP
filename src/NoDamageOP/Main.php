<?php

namespace NoDamageOP;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as Color;
use pocketmine\Player;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\level\Position;
use pocketmine\item\Item;
use pocketmine\level\Level;
use pocketmine\math\Vector3;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerMoveEvent;


class Main extends PluginBase implements Listener {

    private $players = [];

	public function onEnable()
	{
		  $this->getLogger()->info(Color::AQUA . "NoDamageOP Enabled By @lovetwice1012");
 
        }
    public function onMove(PlayerMoveEvent $event): void {
    $player = $event->getPlayer();
    //if(!$player->isOp())
      //  return;

    if($player->y < 0) {
        $player->setHealth(20);
        $player->setFood(20);
        $player->teleport($player->getLevel()->getSafeSpawn());
    }
	    echo "test".PHP_EOL;
}


        public
        function onDamage(EntityDamageEvent $event)
        {
                    $player = $event->getEntity();
			//if(!$player->isOp()){
                        //return;
	                //}
                        $event->setCancelled();
                        $player->setHealth(20);
                        $player->setFood(20);
         }
 }
