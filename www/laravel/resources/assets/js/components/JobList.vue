<template>
<el-row>
  <el-col :span="8" v-for="(o, index) in 9" :key="o" :offset="index % 2  > 0 ? 2 : 0" style="margin: 10px">
    <el-card :body-style="{ padding: '0px' }">
      <div slot="header" class="clearfix">
        <span>Card name</span>
        <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button>
      </div>
      <!--<img src="~examples/assets/images/hamburger.png" class="image">-->
      <div style="padding: 14px;">
        <span>Yummy hamburger</span>
        <div class="bottom clearfix">
          <time class="time">{{ currentDate }}</time>
          <el-button type="text" class="button">Operating button</el-button>
        </div>
      </div>
    </el-card>
  </el-col>
</el-row>
</template>

<style>
  .time {
    font-size: 13px;
    color: #999;
  }

  .bottom {
    margin-top: 13px;
    line-height: 12px;
  }

  .button {
    padding: 0;
    float: right;
  }

  .image {
    width: 100%;
    display: block;
  }

  .clearfix:before,
  .clearfix:after {
      display: table;
      content: "";
  }

  .clearfix:after {
      clear: both
  }
</style>

<script>
  import http from '../services/http'
  export default {
    data() {
      return {
        currentDate: new Date()
      };
    }
  }
</script>
