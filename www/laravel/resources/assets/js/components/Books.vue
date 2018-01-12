<!--
<template>
  <div>
    <div>
      <p>Your tasks here.</p>

      <ul v-for="book in books">
        <li>
          {{ book.name }}
          {{ book.author }}
        </li>
      </ul>

    </div>
  </div>
</template>
-->

<template>
  <el-table
    :data="books"
    height="250"
    style="width: 100%">
    <el-table-column
      prop="date"
      label="Date"
      width="180">
    </el-table-column>
    <el-table-column
      prop="name"
      label="Name"
      width="180">
    </el-table-column>
      <el-table-column
      label="Operations">
      <template slot-scope="scope">
        <el-button
          size="mini"
          @click="handleEdit(scope.$index, scope.row)">Edit</el-button>
        <el-button
          size="mini"
          type="danger"
          @click="handleDelete(scope.$index, scope.row)">Delete</el-button>
      </template>
    </el-table-column>
  </el-table>
</template>

<script>
  import http from '../services/http'

  export default {
    mounted() {
      this.fetchBooks()
    },
    data() {
      return {
        books: [],
        author: '',
        created_at: '',
      }
    },
    methods: {
      fetchBooks () {
        // TODO: not to send request when the user is not authenticated
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
