## How to contribute to Avored
- [Bug Reporting](#bug-reporting)
- [Did you fix a bug?](#Did-you-fix-a-bug)
- [Did you create a new feature or enhancement?](#did-you-create-a-new-feature-or-enhancement)
- [Issue and Pull Request Labels](#Issue-and-Pull-Request-Labels)
- [Types of Issue Labels](#Types-of-Issue-Labels)
- [Types of Pull Request Labels](#Types-of-Pull-Request-Labels)

#### **Bug Reporting**
* **Ensure the bug was not already reported** by searching on GitHub under [Issues.](https://github.com/avored/laravel-ecommerce/issues)
* If you're unable to find an open issue that relates to your problem, [open a new one.](https://github.com/avored/laravel-ecommerce/issues/new) Please be sure to follow the issue template as much as possible.
* **Ensure that the bug you are reporting is a Avored issue** and not specific to your individual setup. For these types of issues please use the [Community Forum.](https://www.avored.com/discussion)

#### **Did you fix a bug?**

* To provide a code contribution for an issue you will need to set up your own fork of the Avored repository, make your code changes, commit the changes and make a Pull Request to the dev branch on the Avored repository. 
* Separate each fix into a new branch in your repository and name it with the issue ID e.g. bugfix_3062 or issue-1234.
* When committing to your individual bugfix branch, please try and use the following as your commit message 
```Fixed #1234 - <the subject of the issue>```. By using this format we can easily include all bug fixes within major and minor release notes in our [Changelog](https://github.com/avored/laravel-ecommerce/blob/master/CHANGELOG.md).
* If you are new to writing commit messages in git, follow the guide [here.](http://chris.beams.io/posts/git-commit/#seven-rules)
* After you have made your commits and pushed them up to your forked repository you then create a [Pull Request](https://help.github.com/articles/about-pull-requests/) to be reviewed and merged into the Avored repository. Make a new Pull Request for each issue you fix.    **do not combine multiple bugfixes into one Pull Request**.
* Ensure that you send your Pull Request to the dev.


#### **Did you create a new feature or enhancement?**

* Changes that can be considered a new feature or enhancement should be made to the dev branch.
* To contribute a feature you must create a fork of Avored and set up your git and development environment.
  Once done, create a new branch from **dev** and name it relevant to the feature's purpose.
  Make sure your commit messages are relevant and descriptive. When ready to submit for review, make a Pull Request detailing your feature's functionality.
  Ensure that your Pull Requests base fork is **avored/laravel-ecommerce**, the base branch is **dev**, the head fork is your repository, and the base branch is your feature branch.
* Add any new PHPUnit tests to the new feature branch if required.

## Issue and Pull Request Labels

* This section lists the labels we use to help us track and manage issues and pull requests across the repositories.
* If an issue should be raised as a higher priority for a next release make a comment to that affect. 

#### Types of Issue Labels

| Label name               | Description                                                                  |
| -------------------------|  --------------------------------------------------------------------------- |
| backend                  | Issues relating to avored/framework.                                         |
| bug                      | Confirmed or very likely to be a bug.                                        |
| duplicate                | Issues which are duplicates of other issues.                                 |
| frontend                 | Issues relating to the frontend                                              |
| Fix Proposed             | Issues with a related pull request.                                          |
| High Priority            | A high impact.                                                               |
| invalid                  | Issues that are invalid or non-reproducible.                                 |
| Language                 | Issues relating to language files.                                           |
| Low Priority             | Low impact.                                                                  |
| Medium Priority          | Medium impact.                                                               |
| Pending Input            | Pending input from issue raiser.                                             |
| Suggestion               | Suggestions                                                                  |
| Question                 | General questions (Should usually be posted to the community forum instead). |
| Resolved: Next Release   | Solved issues that will be closed after the next release.                    |

#### Types of Pull Request Labels

| Label name             | Description                                                        |
| ---------------------- | ------------------------------------------------------------------ |
| Community Contribution | Pull requests that have been created by a member of the community. |
| duplicate              | Duplicate of other pull requests.                                  |
| Enhancement            | Pull requests that add additional features or functionality.       |
| In Review              | Currently in-review and requires additional work from creator.     |
| Needs Tests            | Pull requests that require unit tests before they can be merged.  |
| Ready to Merge         | Pull requests that have both been assessed and code reviewed.      |
| Wrong Branch           | Pull requests that have been created to the wrong branch.          |