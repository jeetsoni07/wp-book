# wp-starter

This is a Github [template repo](https://help.github.com/en/github/creating-cloning-and-archiving-repositories/creating-a-template-repository) with just a readme file that you are reading right now and a magical `.github` folder which contains [Github Actions](https://github.com/features/actions) that automatically check your code against [WordPress Coding Standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/).

As you are here, you are most likely looking to work with rtCamp where code quality is very important to us. But even if you have no intention to join rtCamp, you are free to use this repo and automated checks present in it, to improve your WordPress coding skill. 

## Usage

There are three ways to use this template repo:

### 1. Using Github Classroom Assignment Link

1. If you are looking to work with rtCamp, it's better to start [using this assignment link](https://classroom.github.com/a/sC4KV_YZ).
2. When you open the link, Github will prompt you to "Accept this assignment". 
3. Clicking the "Accept..." button creates a private copy of this repo to which you and rtCamp's evaluators will have access. Your access level for the repo will be admin-level.
4. You are expected to push all your codes to this new repo. Make sure you do not touch `.github` folder accidentally as it can break the magic.
5. If you have developed any theme or plugin codes in the past, you are free to push those codes in your private repo. 
6. When pushing existing large code-base, we request you to commit them in chunks — ideally one PHP file at a time. You can commit all non-PHP files at once as rtBot only checks PHP codes at the moment. It is yet to [Learn JavaScript Deeply](https://wesbos.com/learn-javascript)!

**Advantages**
1. You will not have to configure anything. You can just accept the assignment from the link and start pushing your codes right away. 
2. As you are repo-admin for your copy, at any time, you can move the repo to your personal space. After all, you should have right over your code. 

### 2. "Use this template" option 

1. You can click "Use this template" button or [visit this link](https://github.com/rtlearn/wp-starter/generate)
2. You will be prompted to select the name/destination for new repo. 
3. Please note that you may need to configure automated code review yourself. If you do not, your assignment may not be considered for review.
   
### 3. Clone or Fork as a normal repo

You are free to do whatever you would like to do with this repo. Please note that you may need to configure automated code review yourself.

## Automated PHPCS checks
1. The [coding standard rulest](phpcs.xml) in the automated PHPCS checks are configured to check database, security, and basic code analysis related checks mainly. [Ref. to list of rulesets](https://github.com/WordPress/WordPress-Coding-Standards#rulesets).
2. It will not check for inline code comments, code formatting, and spacing issues, those checks have been excluded. But it is good to have these as well in your code.
3. [This](https://learn.rtcamp.com/lessons/coding-standards-and-best-practices/) is a good starting point for understanding the WordPress Coding Standards.
4. [Guide](https://github.com/WordPress/WordPress-Coding-Standards#using-phpcs-and-wpcs-from-within-your-ide) to setup the WordPress Coding Standard checks in your IDE.
