# laravel new-app
alias laravel="git clone -o laravel -b develop https://github.com/laravel/laravel.git"

alias art="php artisan"
alias art:mig="php artisan migrate"
alias art:reset="php artisan migrate:reset && php artisan migrate --seed"
alias art:ref="php artisan migrate:refresh --seed"
alias art:roll="php artisan migrate:rollback"
alias art:cls="php artisan clear-compiled && php artisan cache:clear && php artisan view:clear && php artisan route:clear && php artisan optimize"
alias t="vendor/bin/phpunit"
alias art:sch="php artisan schedule:run"
alias art:cmpl="php artisan clear-compiled"
alias seed="php artisan make:seeder"
alias ejeseed="php artisan db:seed --class="
alias art:mig:seed "php artisan migrate --seed"

alias art:jobs="art queue:work --sleep=3 --tries=3 --daemon"

alias comp:da="composer dump-autoload"
alias art:dump="php artisan dump autoload"
alias art:cac="php artisan cache:clear"
alias art:vc="php artisan view:clear"
alias art:rc="php artisan route:clear"
alias art:opt="php artisan optimize"


# Generators Package
alias g:c="php artisan generate:controller"
alias g:m="php artisan generate:model"
alias g:v="php artisan generate:view"
alias g:mig="php artisan generate:migration"
alias g:t="php artisan generate:test"
alias g:r="php artisan generate:resource"
alias g:s="php artisan generate:scaffold"
alias g:f="php artisan generate:form"

# Git
alias ga="git add"
alias gaa="git add ."
alias gc="git commit -m"
alias gps="git push"
alias gp="git pull"
alias gs="git status"
alias gl="git log --stat=100 --stat-graph-width=12"
alias gdiscard="git clean -df && git checkout -- ."

#Console
alias cls="clear"

#Composer
alias comp:up="C:/ProgramData/ComposerSetup/bin/composer.phar self-update"
