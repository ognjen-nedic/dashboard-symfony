
# Universal Dashboard - Symfony

This is interpretation of the Universal Dashboard project which can be seen at this Figma [link](https://www.figma.com/file/hInUFuytlSizIayBAtlxOF/Universal-Akademija?node-id=0%3A1).
There are several changes to the main idea, but overall the concept is the same.
## Installation

To successfully run this project, there are several steps. Prerequisites are Symfony, PHP and Composer knowledge, and their existance on the machine.

In terminal, run these lines in this order:

```bash 
composer install 
``` 
(to install all Symfony extra packages)

```bash 
npm install
```
(to install files for Encore)

```bash 
npm run dev
```
(to enable Encore)


Be sure to put `universal_dashboard.sql` file into you Database system, and check for configuration in the `.env` file under the `doctrine/doctrine-bundle` section.

## Using the application

There are 2 types of Users on this site:

#### Administrator 
- This user can add new clients, access information about them, update them and delete them.
- Change information about other type of User - the Developer.
- Read which Tasks are appointed to clients.

To login as this User, use these credentials: 

ognjen.nedic@universal.com | lawoman

#### Developer
- This user can't access anything about clients, except choose them as an option when adding new task.
- Add new tasks, update them, read them (but only appointed to themselves) and delete them.

To login as this User, use these credentials: 

lizard.king@universal.com | lawoman

