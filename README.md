# symf_log_reg

symfony check:requirements
symfony new my_app
cd my_app
composer require webapp
.env Set Database Configuration
sudo /opt/lampp/lampp start  - XAMPP start
php bin/console doctrine:database:create
php bin/console make:controller Dashboard
$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

src\Controller\DashboardController.php

<?php
 
namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
 
class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}

php bin/console make:user 
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console make:auth
return new RedirectResponse($this->urlGenerator->generate('app_dashboard'));

src\Security\AppCustomAuthenticator.php

public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }
 
        // For example:
        return new RedirectResponse($this->urlGenerator->generate('dashboard'));
        // throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
    }

php bin/console make:registration
symfony server:start

# All

How To Make A User Login and Registration In Symfony 6
June 2, 2022 PHP / Symfony
How To Make A User Login and Registration In Symfony 6
Avatar photoPosted by Binarytuts

In this blog, We will be creating a user login and registration in Symfony 6. Most web apps today that have users or different types of users require login or authentication to safeguard the functionalities and data information of the system. And today, I will show you how to make a user login and registration in Symfony 6.

What is Symfony? Symfony is a PHP framework used to develop web applications, APIs, microservices, and web services. Symfony is one of the leading PHP frameworks for creating websites and web applications.

Prerequisite:
Composer
Symfony CLI
MySQL
PHP >= 8.0.2

Step 1: Install Symfony 6
First, select a folder that you want Symfony to be installed then execute this command on Terminal or CMD to install:

Install via composer:

1
composer create-project symfony/website-skeleton symfony-6-login-register
Install via Symfony CLI:

1
symfony new symfony-6-login-register --full
Step 2: Set Database Configuration
After installing, open the .env file and set the database configuration. We will be using MySQL in this tutorial. Uncomment the DATABASE_URL variable for MySQL and updates its configs. Make sure you commented out the other DATABASE_URL variables.

.env

# In all environments, the following files are loaded if they exist,
# the latter taking precedence over the former:
#
#  * .env                contains default values for the environment variables needed by the app
#  * .env.local          uncommitted file with local overrides
#  * .env.$APP_ENV       committed environment-specific defaults
#  * .env.$APP_ENV.local uncommitted environment-specific overrides
#
# Real environment variables win over .env files.
#
# DO NOT DEFINE PRODUCTION SECRETS IN THIS FILE NOR IN ANY OTHER COMMITTED FILES.
#
# Run "composer dump-env prod" to compile .env files for production use (requires symfony/flex >=1.2).
# https://symfony.com/doc/current/best_practices.html#use-environment-variables-for-infrastructure-configuration
  
###> symfony/framework-bundle ###
APP_ENV=dev
APP_SECRET=37febf852b869d38be2030babb187e25
###< symfony/framework-bundle ###
  
###> symfony/mailer ###
# MAILER_DSN=smtp://localhost
###< symfony/mailer ###
  
###> doctrine/doctrine-bundle ###
# Format described at https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
# IMPORTANT: You MUST configure your server version, either here or in config/packages/doctrine.yaml
#
# DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"
# DATABASE_URL="postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=13&charset=utf8"
###< doctrine/doctrine-bundle ###
After configuring the database, execute this command to create the database:

1
php bin/console doctrine:database:create

Step 3: Create Dashboard Controller
After setting up the database, we will then create a controller, this controller will be used by the authenticated user.

To create a controller execute this command:

1
php bin/console make:controller Dashboard
After executing the command, open this file ‘src\Controller\DashboardController.php’, and add this code:

src\Controller\DashboardController.php

<?php
 
namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
 
class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
Step 4: Create User Class
We will then create a user class, by using the make:user command – this command will create a User class for security and it will automatically update the security.yaml.

Follow these steps:

php bin/console make:user       
 
 The name of the security user class (e.g. User) [User]:
 >
 
 Do you want to store user data in the database (via Doctrine)? (yes/no) [yes]:
 >
 
 Enter a property name that will be the unique "display" name for the user (e.g. email, username, uuid) [email]:
 >
 
 Will this app need to hash/check user passwords? Choose No if passwords are not needed or will be checked/hashed by some other system (e.g. a single sign-on server).
 
 Does this app need to hash/check user passwords? (yes/no) [yes]:
 >
 
 created: src/Entity/User.php
 created: src/Repository/UserRepository.php
 updated: src/Entity/User.php
 updated: config/packages/security.yaml
 
  
  Success! 
  
 
 Next Steps:
   - Review your new App\Entity\User class.
   - Use make:entity to add more fields to your User entity and then run make:migration.
   - Create a way to authenticate! See https://symfony.com/doc/current/security.html

Step 5: Create Migration
Then we will create a migration file and then migrate it:

Execute this command to create a migration file:

1
php bin/console make:migration
Then execute this command to run the migration the file:

1
php bin/console doctrine:migrations:migrate
Step 6: Create Login
To create login on Symfony 6, we can use the make:auth command – this command can provide empty authenticator or a full login form authentication process depending of what you have chosen.

Execute this command and follow the steps below:

php bin/console make:auth       
 
 What style of authentication do you want? [Empty authenticator]:
  [0] Empty authenticator
  [1] Login form authenticator
 > 1
1
 
 The class name of the authenticator to create (e.g. AppCustomAuthenticator):
 > AppCustomAuthenticator
 
 Choose a name for the controller class (e.g. SecurityController) [SecurityController]:
 >
 
 Do you want to generate a '/logout' URL? (yes/no) [yes]:
 >
 
 created: src/Security/AppCustomAuthenticator.php
 updated: config/packages/security.yaml
 created: src/Controller/SecurityController.php
 created: templates/security/login.html.twig
 
            
  Success! 
            
 
 Next:
 - Customize your new authenticator.
 - Finish the redirect "TODO" in the App\Security\AppCustomAuthenticator::onAuthenticationSuccess() method.
 - Check the user's password in App\Security\AppCustomAuthenticator::checkCredentials().
 - Review & adapt the login template: templates/security/login.html.twig.
After following the steps above, open the file ‘src\Security\AppCustomAuthenticator.php’ and update a part of the code:

src\Security\AppCustomAuthenticator.php

public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }
 
        // For example:
        return new RedirectResponse($this->urlGenerator->generate('dashboard'));
        // throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
    }

Step 7: Create Registration
After creating the Login we will then create the Registration. We can use the make:registration command.

Execute this command and follow the steps below:

php bin/console make:registration
 
 Creating a registration form for App\Entity\User
 
 Do you want to add a @UniqueEntity validation annotation on your User class to make sure duplicate accounts aren't created? (yes/no) [yes]:
 > 
 
 Do you want to send an email to verify the user's email address after registration? (yes/no) [yes]:
 > no
 
 Do you want to automatically authenticate the user after registration? (yes/no) [yes]:
 >
 
 updated: src/Entity/User.php
 created: src/Form/RegistrationFormType.php
 created: src/Controller/RegistrationController.php
 created: templates/registration/register.html.twig
  
  Success! 
  
 
 Next:
 Make any changes you need to the form, controller & template.
 
 Then open your browser, go to "/register" and enjoy your new form!

Step 6: Run the Application
After finishing the steps above, you can now run your application by executing the command below:

1
symfony server:start
After successfully running your app, open these URL’s in your browser:

Login:

1
https://localhost:8000/login
Register:

1
https://localhost:8000/register
Dashboard(If authenticated):

1
https://localhost:8000/dashboard