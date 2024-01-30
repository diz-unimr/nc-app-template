<?php

declare(strict_types=1);
// SPDX-FileCopyrightText: Sebastian Stöcker <sebastian.stoecker@uni-marburg.de>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\TemplateApp\Tests\Unit\Controller;

use OCA\TemplateApp\Controller\NoteController;
use OCA\TemplateApp\Service\NoteNotFound;
use OCA\TemplateApp\Service\NoteService;
use OCA\TemplateApp\Db\Note;

use OCP\AppFramework\Http;
use OCP\IRequest;
use PHPUnit\Framework\TestCase;

class NoteControllerBase extends TestCase {
	protected string $userId = 'john';
	protected $service;
	protected $request;

	public function testUpdate(): void {
		$note = Note::fromRow([
        			'id' => 3,
        			'title' => 'title',
        			'content' => 'just check if this value is returned correctly'
        		]);
		$this->service->expects($this->once())
			->method('update')
			->with($this->equalTo(3),
				$this->equalTo('title'),
				$this->equalTo('content'),
				$this->equalTo($this->userId))
			->will($this->returnValue($note));

		$result = $this->controller->update(3, 'title', 'content');

		$this->assertEquals($note, $result->getData());
	}


	public function testUpdateNotFound(): void {
		// test the correct status code if no note is found
		$this->service->expects($this->once())
			->method('update')
			->will($this->throwException(new NoteNotFound()));

		$result = $this->controller->update(3, 'title', 'content');

		$this->assertEquals(Http::STATUS_NOT_FOUND, $result->getStatus());
	}
}
