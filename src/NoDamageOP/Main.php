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
use pocketmine\event\entity\EntityEffectAddEvent;

class Main extends PluginBase implements Listener {

	private $players = [];

	public function onEnable(){
        	$this->getServer()->getPluginManager()->registerEvents($this ,$this);
        }
	
	
        public function onMove(PlayerMoveEvent $event): void {
        	$player = $event->getPlayer();
        	if(!$player->isOp()){
           		return;
            	}
            	if($player->y < 0) {
                	$player->setHealth(20);
                	$player->setFood(20);
               		$player->teleport($player->getLevel()->getSafeSpawn());
    	        	$this->getLogger()->info("§aBecause ".$player->getName()." was about to fall into the abyss, I warped the respawn spot.");
	        	$player->sendTip("§aBecause ".$player->getName()." was about to fall into the abyss, I warped the respawn spot.");
            	}
        }


        public function onDamage(EntityDamageEvent $event){
            	$player = $event->getEntity();
		if($event->getEntity() instanceof Player){
            		if(!$player->isOp()){
                		return;
	    		}
            		$event->setCancelled();
            		$player->setHealth(20);
            		$player->setFood(20);
			if($event->getFinalDamage() > 0){
	    			$this->getLogger()->info("§aDisabled §6".$event->getFinalDamage()."§a damage received by ".$player->getName());
            			$player->sendTip("§aDisabled §6".$event->getFinalDamage()."§a damage received by ".$player->getName());
			}
		}
			
	}
	
	
	public function  onEffectAdded(EntityEffectAddEvent $event) : void {
		$player = $event->getEntity();
            	if($event->getEntity() instanceof Player && $event->getEffect()->getType()->isBad() && $event->getEntity()->isOp()){
                	$event->setCancelled();
			$this->getLogger()->info("§aDisabled §6".$event->getFinalDamage()."§a effect received by ".$player->getName());
			$event->getEntity()->sendTip("§aDisabled §6".$event->getFinalDamage()."§a effect received by ".$player->getName());
             	}
        }
 }

