<template>
    <footer>
        © Copyright {{ currentYear }}
    </footer>
</template>
<script>
    export default {
        data() {
            return {
                currentYear: new Date().getFullYear()
            }
        }
    }
</script>