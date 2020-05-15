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
		$this->getLogger()->info(Color::AQUA . "NoDamageOP Enabled By @lovetwice1012");
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
    	        	$this->getLogger()->info("§a".$player->getName()."が奈落に落ちそうになったためリスポーン地点にワープさせました。");
	        	$player->sendTip("§a".$player->getName()."が奈落に落ちそうになったためリスポーン地点にワープさせました。");
            	}
        }


        public function onDamage(EntityDamageEvent $event){
            	$player = $event->getEntity();
            	if(!$player->isOp()){
                	return;
	    	}
            	$event->setCancelled();
            	$player->setHealth(20);
            	$player->setFood(20);
	    	$this->getLogger()->info("§a".$player->getName()."に与えられた§6".$event->getBaseDamage()."§aダメージを無効化しました。");
            	$player->sendTip("§a".$player->getName()."に与えられた§6".$event->getBaseDamage()."§aダメージを無効化しました。");
         }
	
	
	public function  onEffectAdded(EntityEffectAddEvent $event) : void {
            	if($event->getEntity() instanceof Player && $event->getEffect()->getType()->isBad() && $event->getEntity()->isOp()){
                	$event->setCancelled();
			$this->getLogger()->info("§a".$event->getEntity()->getName()."に与えられた§6".$event->getEffect()->getType()->getName()."§aエフェクトを無効化しました。");
			$event->getEntity()->sendTip("§a".$event->getEntity()->getName()."に与えられた§6".$event->getEffect()->getType()->getName()."§aエフェクトを無効化しました。");
             	}
        }
 }
