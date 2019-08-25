# TODO

- setup development environment
  - PHP on docker for development
- develop a mini MVC framework
- develop a basic app to use the framework
- generate sample data
- Update the app to load the data
- update the app to visualize the data

## Progress

- Start recording decisions
- Install GIT
- GNU Make
  - Install MinGW
    - After install renaming was needed. Inspired by [this post](https://stackoverflow.com/questions/12881854/how-to-use-gnu-make-on-windows) but adapted to use symlink instead of copy
  - Symlink make
    - `mklink make.exe mingw32-make.exe`
  - Add `mingw/bin` to PATH
- Install Docker
  - Oops, I have Windows Home. Using Docker Toolbox instead of Docker Desktop
    - [Confirms its a valid solution in 2019](https://thewebspark.com/2019/04/04/how-to-install-docker-on-windows-10-home-edition-solved/)
    - Error in stating, removing the `default` machine solved it
- mounting volumes in docker
  - [Solving share problem](http://support.divio.com/en/articles/646695-how-to-use-a-directory-outside-c-users-with-docker-toolbox-docker-for-windows)
- [Terminal color error](https://stackoverflow.com/questions/6804208/nano-error-error-opening-terminal-xterm-256color)
- Switched to Linux. Hell broke loose for Docker.
- [Installing mysql extnesions](https://stackoverflow.com/questions/44603941/how-to-enable-pdo-mysql-in-the-php-docker-image)
- [Helpful for docker](https://www.shiphp.com/blog/2017/php-mysql-docker)
- https://bitpress.io/simple-approach-using-docker-with-php/
- The chart: is last month a calendar month or last 30 days. The google drive image shows last 30 days, hence I'll do the same. If time permits, I'll make the default configurable. (I shouldn't overdo it, maybe not then)
- https://gist.github.com/spalladino/6d981f7b33f6e0afe6bb
- https://stackoverflow.com/questions/6739871/how-to-create-an-array-for-json-using-php
- https://stackoverflow.com/questions/27238411/display-curl-output-in-readable-json-format-in-unix-shell-script
- https://coderwall.com/p/fasnya/add-git-branch-name-to-bash-prompt
- https://gist.github.com/jcavat/2ed51c6371b9b488d6a940ba1049189b
- > > > DB abstraction isn't good, later when refactoring
- > > > Hanev't done much Dependency injection, later when refactoring
- I added currency to db function but didn't use it
