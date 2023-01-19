<?php

/*
 *         .__                                       .___
 * ______  |  |__  ______    ____   ____ _______   __| _/
 * \____ \ |  |  \ \____ \ _/ ___\ /  _ \\_  __ \ / __ |
 * |  |_> >|   Y  \|  |_> >\  \___(  <_> )|  | \// /_/ |
 * |   __/ |___|  /|   __/  \___  >\____/ |__|   \____ |
 * |__|         \/ |__|         \/                    \/
 *
 *
 * This library is developed by HimmelKreis4865 © 2022
 *
 * https://github.com/HimmelKreis4865/phpcord
 */

namespace phpcord\runtime\network\opcode;

use phpcord\intent\IntentPool;
use phpcord\runtime\network\MessageSender;
use phpcord\runtime\network\Network;
use phpcord\runtime\network\packet\MessageBuffer;

class DispatchHandler extends OpCodeHandler {
	
	/**
	 * @internal
	 *
	 * @return int
	 */
	public function getOpCode(): int {
		return Opcodes::DISPATCH();
	}
	
	/**
	 * @internal
	 *
	 * @param MessageSender $sender
	 * @param MessageBuffer $buffer
	 *
	 * @return void
	 */
	public function handle(MessageSender $sender, MessageBuffer $buffer): void {
		if (!isset($buffer->asArray()['t'])) {
			Network::getInstance()->getLogger()->error('Payload ' . $buffer . ' is invalid due to no intent was specified.');
			return;
		}
		IntentPool::getInstance()->dispatch($buffer);
	}
}