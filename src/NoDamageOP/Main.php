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

    public function onMove(PlayerMoveEvent $event)
    {
        $player = $event->getPlayer();
	
        if ($event->getPlayer()->getY() < -1) {
        if ($player->isOp()) {
            $event->getPlayer()->teleport($event->getPlayer()->getLevel()->getSafeSpawn());
            $player->setHealth(20);
            $player->setFood(20);
            
	}
        }
    }


        public
        function onDamage(EntityDamageEvent $event)
        {

		
                    $player = $event->getEntity();
			if($player->isOp()){
                        $event->setCancelled();
                        $player->setHealth(20);
                        $player->setFood(20);
                   

                        }
                    
                
         }
 }
