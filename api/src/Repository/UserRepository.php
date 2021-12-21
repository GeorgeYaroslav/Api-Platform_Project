<?php

	namespace App\Repository;

	use App\Entity\User;
	use App\exceptions\user\UserNotFoundException;
	use Doctrine\ORM\OptimisticLockException;
	use Doctrine\ORM\ORMException;

	class UserRepository extends BaseRepository

	{
		protected static function  entityClass(): string
		{
			return User::class;
		}

		// Esto es lo que se conoce como tellDontAsk methods, this methods search in the objectrepository
		// if exists the email that was be sended, and if it's not found put a throw

		public function findOneByEmailOrFail(string $email): User
		{
			if (null === $user = $this->objectRepository->findOneBy(['email' => $email])){
				throw UserNotFoundException::fromEmail($email);
			}

			return $user;
		}

		/**
		 * @throws ORMException
		 * @throws OptimisticLockException
		 */
		public function saveUser(User $user): void
		{
			$this->saveEntity($user);
		}

		/**
		 * @throws OptimisticLockException
		 * @throws ORMException
		 */
		public function removeUser(User $user): void
		{
			$this->removeEntity($user);
		}
	}