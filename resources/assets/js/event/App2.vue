<template>
  <div>
	  <div class="example">{{ msg }}</div>
	  <div id="test">{{ msg }}</div>'
  </div>
</template>

<script>
export default {
  data () {
    return {
      msg: 'Hello world!'
    }
  }
}
</script>

<style>
.example {
  color: red;
}
</style>