<?php
# plugin hecho por KaitoDoDo
namespace KaitoDoDo\Team;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\Player;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class Team extends PluginBase implements Listener {
	
	public function onEnable()
	{
		  $this->getLogger()->info(TextFormat::DARK_AQUA . "§cTeams §9by §aKaitoDoDo");

        $this->getServer()->getPluginManager()->registerEvents($this ,$this);
		@mkdir($this->getDataFolder());
                $config2 = new Config($this->getDataFolder() . "/team.yml", Config::YAML);
		$config2->save();
        }
        
	public function onCommand(CommandSender $player, Command $cmd, $label, array $args) {
            
        switch($cmd->getName()){
                        
                        case "team":
					
                            if(!empty($args[0]))
					{
                            
                            if($args[0]=="red")
					{
						$team = "§l§c[RED]";
					}
					else if($args[0]=="blue")
					{
						$team = "§l§9[BLUE]";
					}
					else if($args[0]=="green")
					{
						$team = "§l§a[GREEN]";
					}
					else
					{
						$team = "§l§e[YELLOW]";
					}
					$config = new Config($this->getDataFolder() . "/team.yml", Config::YAML);
                                        $name = $player->getName();
                                        $player->setNameTag($team . $name);
					$config->set($name,$team);
					$config->save();
					$player->sendMessage("You entered to: " . $team . " §fteam");
                                        foreach($this->getServer()->getOnlinePlayers() as $jugadores)
                                        {
                                            $jugadores->sendMessage($name . " Has entered in: " . $team . " §fteam");
                                        }
					}
                                        else{
                                            $player->sendMessage("Missing parameters");
                                        }
        
				
			return true;
			
        }
        }
        
        public function onEntityDamage(EntityDamageEvent $event){
            if ($event instanceof EntityDamageByEntityEvent) {
                if ($event->getEntity() instanceof Player && $event->getDamager() instanceof Player) {
            $golpeado = $event->getEntity()->getNameTag();
            $golpeador = $event->getDamager()->getNameTag();
            if ((strpos($golpeado, "§l§c[RED]") !== false) && (strpos($golpeador, "§l§c[RED]") !== false)) { 
                    
                $event->setCancelled();
}
else if ((strpos($golpeado, "§l§9[BLUE]") !== false) && (strpos($golpeador, "§l§9[BLUE]") !== false)) { 
                    
                $event->setCancelled();
}
else if ((strpos($golpeado, "§l§a[GREEN]") !== false) && (strpos($golpeador, "§l§a[GREEN]") !== false)) { 
                    
                $event->setCancelled();
                }
else if ((strpos($golpeado, "§l§e[YELLOW]") !== false) && (strpos($golpeador, "§l§e[YELLOW]") !== false)) { 
                    
                $event->setCancelled();
                }
}
            
        }
            }
}
