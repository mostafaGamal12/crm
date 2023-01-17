<?php

namespace App\Providers;

use App\Repository\CityRepository;
use App\Repository\CountryRepository;
use App\Repository\DistrictRepository;
use App\Repository\GovernorateRepository;
use App\Repository\Interfaces\CityRepositoryInterface;
use App\Repository\Interfaces\CountryRepositoryInterface;
use App\Repository\Interfaces\DistrictRepositoryInterface;
use App\Repository\Interfaces\GovernorateRepositoryInterface;
use App\Repository\Interfaces\PermissionRepositoryInterface;
use App\Repository\Interfaces\ProjectFeatureRepositoryInterface;
use App\Repository\Interfaces\ProjectRepositoryInterface;
use App\Repository\Interfaces\ProjectTypeRepositoryInterface;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\Repository\Interfaces\RoleRepositoryInterface;
use App\Repository\Interfaces\SettingRepositoryInterface;
use App\Repository\Interfaces\LogRepositoryInterface;
use App\Repository\Interfaces\StatusRepositoryInterface;
use App\Repository\Interfaces\ActionRepositoryInterface;
use App\Repository\ActionRepository;
use App\Repository\AmbassadorRepository;
use App\Repository\ChannelRepository;
use App\Repository\CompanyRepository;
use App\Repository\ImageRepository;
use App\Repository\Interfaces\AmbassadorRepositoryInterface;
use App\Repository\Interfaces\ChannelRepositoryInterface;
use App\Repository\Interfaces\CompanyRepositoryInterface;
use App\Repository\Interfaces\ImageRepositoryInterface;
use App\Repository\Interfaces\BrokerRepositoryInterface;
use App\Repository\Interfaces\UnitTypeRepositoryInterface;
use App\Repository\PermissionRepository;
use App\Repository\ProjectFeatureRepository;
use App\Repository\ProjectRepository;
use App\Repository\ProjectTypeRepository;
use App\Repository\UserRepository;
use App\Repository\RoleRepository;
use App\Repository\SettingRepository;
use App\Repository\LogRepository;
use App\Repository\BrokerRepository;
use App\Repository\StatusRepository;
use App\Repository\UnitTypeRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(LogRepositoryInterface::class, LogRepository::class);
        $this->app->bind(StatusRepositoryInterface::class, StatusRepository::class);
        $this->app->bind(ActionRepositoryInterface::class, ActionRepository::class);
        $this->app->bind(UnitTypeRepositoryInterface::class, UnitTypeRepository::class);
        $this->app->bind(ChannelRepositoryInterface::class, ChannelRepository::class);
        $this->app->bind(AmbassadorRepositoryInterface::class, AmbassadorRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(GovernorateRepositoryInterface::class, GovernorateRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(DistrictRepositoryInterface::class, DistrictRepository::class);
        $this->app->bind(ProjectTypeRepositoryInterface::class, ProjectTypeRepository::class);
        $this->app->bind(ProjectFeatureRepositoryInterface::class, ProjectFeatureRepository::class);
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(BrokerRepositoryInterface::class, BrokerRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
    }
}