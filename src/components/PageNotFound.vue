<template>
    <Header></Header>
    <h2>Wrong link </h2> 
        <p>Note: Error 401: Wrong API Key</p>
        <p>Error 404: Wrong food Id</p>
        <p>716429<br>
            Apple Or Peach Strudel - ID: 73420<br>
Apricot Glazed Apple Tart - ID: 632660<br>
Baked Apples in White Wine - ID: 90629<br>
Chocolate Silk Pie with Marshmallow Meringue - ID: 284420</p>   

</template>

<script>
import Header from './Header.vue'; 

export default {
    name: 'PagenotFound',
    components: {
        Header
    }
}
</script>