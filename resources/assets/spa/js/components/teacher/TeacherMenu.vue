<template src="../templates/menu.html"></template>

<script type="text/javascript">
    export default {
        data(){
            return {
                menus: [
                    {name: "Minhas turmas", routeName: 'class_informations.list'}
                ],
                brandRouteName: 'class_informations.list'
            }
        },
    };
</script>