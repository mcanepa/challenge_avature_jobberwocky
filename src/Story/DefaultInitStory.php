<?php

namespace App\Story;

use Zenstruck\Foundry\Story;
use App\Factory\CompanyFactory;
use App\Factory\JobFactory;
use App\Factory\UserFactory;

final class DefaultInitStory extends Story
{
	public function build(): void
	{
		CompanyFactory::createMany(5);
		UserFactory::createMany(3);
		JobFactory::createMany(50);
	}
}
