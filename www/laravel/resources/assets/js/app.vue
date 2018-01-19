<template>
  <div id="app">
    <el-container style="height: 100%; border: 1px solid #eee">
        <el-aside width="200px" style="background-color: rgb(238, 241, 246)">

         <el-menu :default-openeds="['1', '1']">
          <el-submenu index="1">
            <template slot="title"><i class="el-icon-star-off"></i>Menu</template>
              <router-link :to="{ name: 'books'}">
                <el-menu-item index="1-1">
                  Books List
                </el-menu-item>
              </router-link>
              <router-link :to="{ name: 'addBook'}">
                <el-menu-item index="1-2">
                  Add Book
                </el-menu-item>
              </router-link>
          </el-submenu>
         </el-menu>

        </el-aside>
        <el-main>
            <div>
              <router-view></router-view>
            </div>
        </el-main>
    </el-container>
  </div>
</template>
