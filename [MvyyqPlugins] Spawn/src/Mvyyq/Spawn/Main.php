<?php

namespace Mvyyq\Spawn;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener
{

    protected function onEnable(): void
    {
        $this->getLogger()->notice(TextFormat::YELLOW . "[Mvyyq-Plugins] Spawn plugin loaded.");

        $this->config = $this->getConfig()->getAll();
    }

    protected function onDisable(): void
    {
        $this->getLogger()->notice(TextFormat::RED . "[Mvyyq-Plugins] Spawn plugin unloaded.");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        $spawn = Server::getInstance()->getWorldManager()->getDefaultWorld()->getSafeSpawn();
        if ($sender instanceof Player) {
            $sender->teleport($spawn);
            $sender->sendActionBarMessage($this->config["spawn-tp-message"]);
        }
        return true;
    }
}