<?php

namespace MC;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener {
	
	public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, String $label, array $args) : bool{
		switch($cmd->getName()) {
               case "heal":
			     if($sender->hasPermission("heal.cmd")) {
				   if($sender instanceof Player){
					   if (isset($args[0])) {
						   $player = $this->getServer()->getPlayer($args[0]);
						   $player->setHealth(20);
						   $player->sendMessage($this->getConfig()->get("HealMessage"));
             } else {
               $sender->setHealth(20);
               $sender->sendMessage($this->getConfig()->get("HealMessage"));
             }
				   } else {
             $sender->sendMessage("§cPuoi eseguire questo comando solo in-game!");
           }
         } else {
           $sender->sendMessage("§cYou don't have enough permission!");
         }
				break;
				case "food":
				  if($sender->hasPermission("food.cmd")) {
				   if($sender instanceof Player){
					   if (isset($args[0])) {
						   $player = $this->getServer()->getPlayer($args[0]);
						   $player->setFood(20);
						   $player->sendMessage($this->getConfig()->get("FoodMessage"));
             } else {
               $sender->setFood(20);
               $sender->sendMessage($this->getConfig()->get("FoodMessage"));
             }
				   } else {
             $sender->sendMessage("§cPuoi eseguire questo comando solo in-game!");
           }
         } else {
           $sender->sendMessage("§cYou don't have enough permission!");
         }
				break;
				case "hub":
				  if($sender instanceof Player){
					     $sender->teleport($this->getServer()->getDefaultLevel()->getSafeSpawn());
               $sender->sendMessage($this->getConfig()->get("HubMessage"));
				  }	else {
            $sender->sendMessage("§cPuoi eseguire questo comando solo in-game!");
          }
				break;
				case "spawn":
				  if($sender instanceof Player){
					     $sender->teleport($this->getServer()->getDefaultLevel()->getSafeSpawn());
               $sender->sendMessage($this->getConfig()->get("SpawnMessage"));
				  }	else {
            $sender->sendMessage("§cPuoi eseguire questo comando solo in-game!");
          }
          break;
		}
		return true;
    }
    
    public function onFallDamage(EntityDamageEvent $event) {
	      if ($event->getCause() == EntityDamageEvent::CAUSE_FALL) {
			  $event->setCancelled(true);
		  }
	}
		  
   public function onHunger(PlayerExhaustEvent $event) {
        $event->setCancelled(true);
   }		  
}