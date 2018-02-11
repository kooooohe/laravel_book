<template>
<el-form :inline="false" :model="addJobForm" ref="addJobForm" class="">
  <el-form-item
  prop="title"
  label="Title"
  :rules="[{
      required: true ,message: 'title is required', trigger: 'blur'
      }]"
  >
    <el-input v-model="addJobForm.title" placeholder="title"></el-input>
  </el-form-item>
  <el-form-item label="Description">
    <el-input
      type="textarea"
      :autosize="{ minRows: 2, maxRows: 4}"
      placeholder="description"
      v-model="addJobForm.description">
    </el-input>
  </el-form-item>
  <el-form-item label="Deadline">
    <el-date-picker
      v-model="addJobForm.dead_line"
      type="date"
      value-format="yyyy-MM-dd"
      placeholder="Pick a date"
      >
    </el-date-picker>
  </el-form-item>
  <el-form-item label="Amount(yen)">
    <el-input-number v-model="addJobForm.yen" :min="0" :max="10"></el-input-number>
  </el-form-item>
  <el-form-item>
    <el-button type="primary" @click="onSubmit('addJobForm')">Submit</el-button>
  </el-form-item>
</el-form>

</template>

<script>
  import http from '../services/http'

  export default {
    data() {
      return {
          addJobForm: {
            title:'',
            description:'',
            dead_line:'',
            yen: 0,
            response:[],
          }
      }
    },
    methods: {
      onSubmit(formName) {
        //check validation
        this.$refs[formName].validate((valid) => {
          if (valid) {

            http.post('addjob', {title: this.addJobForm.title, description: this.addJobForm.description, dead_line: this.addJobForm.dead_line, yen: this.addJobForm.yen}, res => {
              this.response = res.data
            });

            this.$message({
              showClose: true,
              message: 'You posted ' + this.addJobForm.title,
              type: 'success'
            });

            //this.addJobForm.title = "";
            //this.addJobForm.description = "";
            //this.addJobForm.yen = 0;
            //this.addJobForm.dead_line = "";

          } else {
            this.$message({
              showClose: true,
              message: 'error',
              type: 'error'
            });
            console.log('error submit!!');
            return false;
          }
        });

        console.log(this.response);
      },
      //fetchBooks () {
      //  http.get('books', res => {
      //    this.books = res.data
      //  })
      //},
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
