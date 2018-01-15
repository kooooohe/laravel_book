
<template>
<el-form :inline="false" :model="addBookForm" class=""  >
  <el-form-item label="Name" :rules="[{ required: true ,message: 'name is required'}]">
    <el-input v-model="addBookForm.name" placeholder="name"></el-input>
  </el-form-item>
  <el-form-item label="Author">
    <el-input v-model="addBookForm.author" placeholder="author"></el-input>
  </el-form-item>
    <!--
  <el-form-item label="Activity zone">
    <el-select v-model="addBookForm.author" placeholder="Activity zone">
      <el-option label="Zone one" value="shanghai"></el-option>
      <el-option label="Zone two" value="beijing"></el-option>
    </el-select>
  </el-form-item>
  -->
  <el-form-item>
    <el-button type="primary" @click="onSubmit">Submit</el-button>
  </el-form-item>
</el-form>

</template>

<script>
  import http from '../services/http'

  export default {
    mounted() {
      this.fetchBooks()
    },
    data() {
      return {
          addBookForm: {
            name:'',
            author:'',
            test:[],
          }
      }
    },
    methods: {
      onSubmit() {
        http.post('addbook', {name: this.addBookForm.name, author: this.addBookForm.author}, res => {
          //this.tasks[res.data.id] = res.data
          //this.name = ''
          this.showAlert = false
          this.alertMessage = 'Book is added'
          this.alertMessage = 'Book is added'
          this.test = res.data
        })
        console.log(this.test);
      },
      fetchBooks () {
        http.get('books', res => {
          this.books = res.data
        })
      },
      //addTask () {
      //  if (this.name === '') {
      //    this.showAlert = true
      //    this.alertMessage = 'Task name should not be blank.'
      //    return false
      //  }
      //  http.post('tasks', {name: this.name}, res => {
      //    this.tasks[res.data.id] = res.data
      //    this.name = ''
      //    this.showAlert = false
      //    this.alertMessage = ''
      //  })
      //},
      //completeTask (task) {
      //  http.put('tasks/' + task.id, {is_done: !task.is_done}, res => {
      //    this.tasks[task.id] = res.data
      //    this.$forceUpdate()
      //  })
      //},
      //removeTask (task) {
      //  http.delete('tasks/' + task.id, {}, () => {
      //    delete this.tasks[task.id]
      //    this.$forceUpdate()
      //  })
      //},
    }
  }
</script>
