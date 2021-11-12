<?php

namespace RevandDev;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\nbt\CompundTag;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;

use pocketmine\inventory\Inventory;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\inventory\transaction\action\SlotChangeAction;

class Main extends PluginBase implements Listener{
    
    public function onEnable(){
        
        //invmenu
        $this->inventoryApi = $this->getServer()->getPluginManager()->getPlugin("InventoryAPI");
        $this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        
        //db
        @mkdir($this->getDataFolder());
		$this->progress = new Config($this->getDataFolder() . "progress.yml", Config::YAML, array());
		$this->cQ = new Config($this->getDataFolder() . "checkQuest.yml", Config::YAML, array());
                $this->rajin = new Config ($this->getDataFolder() . "rajin.yml", Config::YAML, array());
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
   public function checkQuest($sender){
		return $this->cQ->get($sender);
   }
   
   
    //oncmd
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
        switch($cmd->getName()){
            case "sansquest":
                if($sender instanceof Player){
                    $this->sansQuestMenu($sender);
                    return true;
                }else{
                    $sender->sendMessage("Use In Game");
                }
            break;    
        }
        return true;
    }
    

    
public function rajinCount($player){
    return $this->rajin->get($player);
}
  //menu utama
  public function sansQuestMenu(Player $player){
    $glass1 = Item::get(160, 9, 1);
    $inventory = $this->inventoryApi->createChestGUI();
    $inventory->setName("§7[§l§eSans§bQuest§r§7]"); 
    $inventory->setViewOnly(); 
    $inventory->setItem(0, $glass1);
    $inventory->setItem(1, $glass1);
    $inventory->setItem(2, $glass1);
    $inventory->setItem(3, $glass1);
    $inventory->setItem(4, $glass1);
    $inventory->setItem(5, $glass1);
    $inventory->setItem(6, $glass1);
    $inventory->setItem(7, $glass1);
    $inventory->setItem(8, $glass1);
    $inventory->setItem(9, $glass1);
    $inventory->setItem(10, $glass1);
    $inventory->setItem(11, Item::get(1, 0, 1)->setCustomName("§l§eQuest 1\n§r\nHancurkan Block Stone 256 Kali\nHadiah: 1 Juta"));
    $inventory->setItem(12, Item::get(87, 0, 1)->setCustomName("§l§eQuest 2\n§r\nHancurkan Block Netherrack 256 Kali\nHadiah: 1,5 Juta"));
    $inventory->setItem(13, Item::get(17, 0, 1)->setCustomName("§l§eQuest 3\n§r\nHancurkan Block Kayu 128 Kali\nHadiah: 2,5 Juta"));
    $inventory->setItem(14, Item::get(17, 0, 1)->setCustomName("§l§eQuest 4\n§r\nPlace Block Kayu 150 Kali\nHadiah: 2,5 Juta"));
    $inventory->setItem(15, Item::get(1, 0, 1)->setCustomName("§l§eQuest 5\n§r\nPlace Block Coblestone 300 Kali\nHadiah: 3,2 Juta"));
    $inventory->setItem(16, $glass1);
    $inventory->setItem(17, $glass1);
    $inventory->setItem(18, $glass1);
    $inventory->setItem(19, $glass1);
    $inventory->setItem(20, $glass1);
    $inventory->setItem(21, $glass1);
    $inventory->setItem(22, $glass1);
    $inventory->setItem(23, $glass1);
    $inventory->setItem(24, $glass1);
    $inventory->setItem(25, $glass1);
    $inventory->setItem(26, $glass1);
    $inventory->setClickCallback([$this, "clickEvent"]);
    $inventory->send($player);
  }    
  
    public function clickEvent(Player $player, Inventory $inventory, Item $source, Item $target, int $slot){
      $p = strtolower($player->getName());
      $checkQuest = $this->checkQuest($p);
      if($source->getName() == "§l§eQuest 1\n§r\nHancurkan Block Stone 256 Kali\nHadiah: 1 Juta"){
            $this->cQ->set($p, "1");
            $this->cQ->save();
            $player->sendMessage("§l§eSansQuest §g> §rKamu Memilih Quest 1");
            $this->progress->set($p, "0");
            $this->progress->save();
            $player->removeWindow($inventory);
      }
      if($source->getName() == "§l§eQuest 2\n§r\nHancurkan Block Netherrack 256 Kali\nHadiah: 1,5 Juta"){
            $this->cQ->set($p, "2");
            $this->cQ->save();
            $player->sendMessage("§l§eSansQuest §g> §rKamu Memilih Quest 2");
            $this->progress->set($p, "0");
            $this->progress->save();
            $player->removeWindow($inventory);
      }
      if($source->getName() == "§l§eQuest 3\n§r\nHancurkan Block Kayu 128 Kali\nHadiah: 2,5 Juta"){
            $this->cQ->set($p, "3");
            $this->cQ->save();
            $player->sendMessage("§l§eSansQuest §g> §rKamu Memilih Quest 3");
            $this->progress->set($p, "0");
            $this->progress->save();
            $player->removeWindow($inventory);
      } 
      if($source->getName() == "§l§eQuest 4\n§r\nPlace Block Kayu 150 Kali\nHadiah: 2,5 Juta"){
            $this->cQ->set($p, "4");
            $this->cQ->save();
            $player->sendMessage("§l§eSansQuest §g> §rKamu Memilih Quest 4");
            $this->progress->set($p, "0");
            $this->progress->save();
            $player->removeWindow($inventory);
      }
      if($source->getName() == "§l§eQuest 5\n§r\nPlace Block Coblestone 300 Kali\nHadiah: 3,2 Juta"){
            $this->cQ->set($p, "5");
            $this->cQ->save();
            $player->sendMessage("§l§eSansQuest §g> §rKamu Memilih Quest 5");
            $this->progress->set($p, "0");
            $this->progress->save();
            $player->removeWindow($inventory);
      } 
    }
    
      
      //breakevent
	public function onBreak(BlockBreakEvent $event) {

        if($event->isCancelled()) {

            return;
        }
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $p = strtolower($player->getName());
        //Quest 1 (Stone)
        if($this->checkQuest($p) == 1){
          if($block->getId() == 1){
            $this->progress->set($p, $this->progress->get($p) + 1);
            $this->progress->save();
            $status = 256 - $this->progress->get($p);
            $player->sendTip("§l§eSansQuest §r\n" . $status . " ×");
            if($this->progress->get($p) == 256){
              $this->eco->addMoney($player, "1000000");
              $this->progress->set($p, "0");
              $this->progress->save();
              $this->cQ->set($p, "0");
              $this->cQ->save();
              $this->rajin->set($p, $this->rajinCount($p) + 1);
              $this->rajin->save();
              $this->getServer()->broadcastMessage("§l§eSansQuest §g> §r" . $player->getName() .
              "Telah menyelesaikan §aQuest 1 §fDan mendapatkan Uang 1 Juta");
            }
          }
        }else if($this->checkQuest($p) == 2){
          if($block->getId() == 87){
              $this->progress->set($p, $this->progress->get($p) + 1);
              $this->progress->save();
              $status = 256 - $this->progress->get($p);
              $player->sendTip("§l§eSansQuest §r\n" . $status . " ×");
              if($this->progress->get($p) == 256){
                  $this->eco->addMoney($player, "1500000");
                  $this->cQ->set($p, "0");
                  $this->progress->set($p, "0");
                  $this->progress->save();
                  $this->cQ->save();
                  $this->rajin->set($p, $this->rajinCount($p) + 1);
                  $this->rajin->save();
                  $this->getServer()->broadcastMessage("§l§eSansQuest §g> §r" . $player->getName() .
                      "Telah menyelesaikan §aQuest 2 §fDan mendapatkan Uang 1,5 Juta");
                    }
                  }
        }else if($this->checkQuest($p) == 3){
          if($block->getId() == 17){
              $this->progress->set($p, $this->progress->get($p) + 1);
              $status = 128 - $this->progress->get($p);
              $this->progress->save();
              $player->sendTip("§l§eSansQuest §r\n" . $status . " ×");
              if($this->progress->get($p) == 128){
                  $this->eco->addMoney($player, "2500000");
                  $this->progress->set($p, "0");
                  $this->progress->save();
                  $this->cQ->set($p, "0");
                  $this->cQ->save();
                  $this->rajin->set($p, $this->rajinCount($p) + 1);
                  $this->rajin->save();
                  $this->getServer()->broadcastMessage("§l§eSansQuest §g> §r" . $player->getName() .
                      " Telah menyelesaikan §aQuest 3 §fDan mendapatkan Uang 2,5 Juta");
                    }
                  }
                }
 }
 
 //Place event
    public function onPlace(BlockPlaceEvent $event) {
        if($event->isCancelled()) {
            return;
        }
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $p = strtolower($player->getName());
        //Quest 4 (Place kayu)
        if($this->checkQuest($p) == 4){
          if($block->getId() == 17){
              $this->progress->set($p, $this->progress->get($p) + 1);
              $this->progress->save();
              $status = 150 - $this->progress->get($p);
              $player->sendTip("§l§eSansQuest §r\n" . $status . " ×");
              if($this->progress->get($p) == 150){
                  $this->eco->addMoney($player, "2500000");
                  $this->progress->set($p, "0");
                  $this->progress->save();
                  $this->cQ->set($p, "0");
                  $this->cQ->save();
                  $this->rajin->set($p, $this->rajinCount($p) + 1);
                  $this->rajin->save();
                  $this->getServer()->broadcastMessage("§l§eSansQuest §g> §r" . $player->getName() .
                      " Telah menyelesaikan §aQuest 4 §fDan mendapatkan Uang 2,5 Juta");
                    }
                  }
                }else if($this->checkQuest($p) == 5){
          if($block->getId() == 4){
              $this->progress->set($p, $this->progress->get($p) + 1);
              $this->progress->save();
              $status = 300 - $this->progress->get($p);
              $player->sendTip("§l§eSansQuest §r\n" . $status . " ×");
              if($this->progress->get($p) == 300){
                  $this->eco->addMoney($player, "3200000");
                  $this->progress->set($p, "0");
                  $this->progress->save();
                  $this->cQ->set($p, "0");
                  $this->cQ->save();
                  $this->rajin->set($p, $this->rajinCount($p) + 1);
                  $this->rajin->save();
                  $this->getServer()->broadcastMessage("§l§eSansQuest §g> §r" . $player->getName() .
                      " Telah menyelesaikan §aQuest 5 §fDan mendapatkan Uang 3,2 Juta");
                    }
                  }
                }
        }
        }

    
    
    
    
    
    

