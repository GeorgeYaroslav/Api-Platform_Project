<?php

	declare(strict_types=1);

	namespace App\exceptions\user;

	use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

	class UserNotFoundException extends NotFoundHttpException
	{
		private const MESSAGE = 'User with email %s Not Found';

		public static function fromEmail(string $email){
			throw new self(\sprintf(self::MESSAGE, $email));
		}

	}