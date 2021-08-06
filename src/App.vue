<template>
  <v-app style="background-color:#f8d24d;">
    <v-app-bar color="#040404" app></v-app-bar>
    <v-snackbar
      top
      :color="alertcolor"
      v-model="snackbar"
      :timeout="3000"
    >
    {{alertword}}
    </v-snackbar>
      <v-main>
        <v-container fill-height fluid>
          <v-row no-gutters justify="center">
            <v-col cols="5" align-self="center">
              <v-row no-gutters justify="center">
                <v-card rounded width="90%" elevation="3" style="padding:30px 40px;">
                  <h1>Personal Information Form</h1>
                  <h2 style="color:grey" v-if="action_edit">(โหมดแก้ไข)</h2>
                  <v-form
                    ref="form"
                  >
                    <v-row no-gutters>
                      <v-col style="margin-right:20px">
                        <v-text-field
                        v-model="formData.fname"
                        :rules="namerules"
                        label="ชื่อ"
                        required
                        ></v-text-field>
                      </v-col>
                      <v-col>
                        <v-text-field
                        v-model="formData.lname"
                        label="นามสกุล"
                        :rules="namerules"
                        required
                        ></v-text-field>
                      </v-col>
                    </v-row>
                    <v-row no-gutters>
                      <v-col style="margin-right:20px">
                        <v-select
                          v-model="formData.sex"
                          :rules="rules"
                          :items="selection_sex"
                          label="เพศ"
                          required
                        ></v-select>
                      </v-col>
                      <v-col>
                        <v-menu
                          v-model="menu"
                          :close-on-content-click="false"
                          :nudge-right="40"
                          transition="scale-transition"
                          offset-y
                          min-width="auto"
                        >
                          <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                              v-model="formData.birthdate"
                              label="วันเดือนปีเกิด"
                              readonly
                              v-bind="attrs"
                              v-on="on"
                            ></v-text-field>
                          </template>
                          <v-date-picker
                            v-model="formData.birthdate"
                            @input="menu = false"
                          ></v-date-picker>
                        </v-menu>
                      </v-col>
                    </v-row>
                    <v-row no-gutters>
                      <v-col style="margin-right:20px">
                        <v-text-field
                        v-model="formData.email"
                        :rules="emailrules"
                        label="อีเมล"
                        required
                        ></v-text-field>
                      </v-col>
                      <v-col>
                        <v-text-field
                        v-model="formData.tel"
                        :rules="telrules"
                        :counter="10"
                        label="เบอร์โทรติดต่อ"
                        required
                        ></v-text-field>
                      </v-col>
                    </v-row>
                    <v-row no-gutters>
                      <v-col>
                        <v-textarea
                          label="ที่อยู่"
                          v-model="formData.address"
                          :rules="addressrules"
                          :counter="30"
                        ></v-textarea>
                      </v-col>
                    </v-row>
                    <v-row style="margin-top:20px;" justify="end">
                      <v-btn dark color="#040404" style="font-weight: bold;" v-on:click="reset()">ยกเลิก</v-btn>
                      <v-btn v-if="action_edit" :loading="bottonloading" light color="#f8d24d" style="font-weight: bold;margin-left:10px" v-on:click="edit()" >บันทึกการแก้ไข</v-btn>
                      <v-btn v-if="!action_edit" :loading="bottonloading" light color="#f8d24d" style="font-weight: bold;margin-left:10px" v-on:click="save()" >ยืนยัน</v-btn>
                    </v-row>
                  </v-form>
                </v-card>
              </v-row>
            </v-col>
            <v-col cols="7" align-self="center">
              <v-row no-gutters justify="center">
                <v-card-title style="width:50%">
                  <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="ค้นหา..."
                    single-line
                    hide-details
                  ></v-text-field>
                </v-card-title>
              </v-row>
               <v-row no-gutters justify="center">
                <v-data-table
                  :loading="tableloading"
                  :headers="headers"
                  :items="rawData"
                  :items-per-page="5"
                  :search="search"
                  elevation="3"
                >
                <template v-slot:item.id="{ item }">
                  <v-btn
                    icon
                    x-small
                    v-on:click="tedit(item)"
                  >
                    <v-icon>mdi-pencil</v-icon>
                  </v-btn>
                  <v-btn
                    icon
                    x-small
                    v-on:click="tremove(item)"
                  >
                    <v-icon>mdi-delete</v-icon>
                  </v-btn>
                </template>
                </v-data-table>
               </v-row>
            </v-col>
          </v-row>
        </v-container>
      </v-main>
    <v-dialog
      v-model="dialog"
      width="500"
    >
      <v-card>
        <v-card-title class="text-h5 grey lighten-2">
          Testing System
        </v-card-title>
        <br>
        <v-card-text>
          คุณต้องการลบข้อมูลของ "{{removename}}" ใช่หรือไม่?
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="light"
            @click="dialog = false"
          >
            ยกเลิก
          </v-btn>
          <v-btn
            color="primary"
            @click="remove()"
          >
            ยืนยัน
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-footer color="#040404" app>
      <v-col
        cols="12"
        style="color:white"
      >
        <center>{{ new Date().getFullYear() }} — <strong>My Quiz Test ,Wiwat Silarak</strong></center>
      </v-col>
    </v-footer>
  </v-app>
</template>

<script>
import axios from 'axios';
export default {
  name: 'App',
  components: {

  },
  data: () => ({
    action_edit:false,
    bottonloading:false,
    tableloading:false,
    dialog:false,
    menu: false,
    snackbar: false,
    alertcolor: '',
    alertword: '',
    removename: '',
    search: '',
    i_remove: 0,
    selection_sex: ['ชาย','หญิง','N/A'],
    formData:{
      id: "",
      fname: "",
      lname: "",
      sex: "",
      birthdate : (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      address : "",
      email : "",
      tel: "",
      action: ""
    },
    rawData: [] ,
    headers: [
      {
        text: 'ชื่อ-นามสกุล',
        align: 'start',
        value: 'name',
      },
      { text: 'เพศ', value: 'sex' },
      { text: 'วันเดือนปีเกิด', value: 'birthdate' },
      { text: 'อีเมล', value: 'email',sortable: false, },
      { text: 'เบอร์โทรศัพท์', value: 'tel',sortable: false, },
      { text: 'ที่อยู่', value: 'address',sortable: false, },
      { text: 'การจัดการ', value: 'id',sortable: false },
    ],
    rules: [
      value => !!value || 'กรุณากรอกให้ครบถ้วน'
    ],
    namerules: [
      value => !!value || 'กรุณากรอกให้ครบถ้วน',
      value => (value || '').length <= 14 || 'สูงสุด 14 ตัวอักษร',
    ],
    addressrules: [
      value => !!value || 'กรุณากรอกให้ครบถ้วน',
      value => (value || '').length <= 30 || 'สูงสุด 30 ตัวอักษร',
    ],
    telrules: [
      value => !!value || 'กรุณากรอกให้ครบถ้วน',
      value => (value || '').length > 8 || 'ตัวเลขน้อยเกินไป',
      value => (value || '').length <= 10 || 'สูงสุด 10 ตัวเลข',
      value => {
        const pattern = /^[0-9]+$/
        return pattern.test(value) || 'โปรดกรอกเฉพาะตัวเลข'
      },
    ],
    emailrules: [
      value => !!value || 'กรุณากรอกให้ครบถ้วน',
      value => (value || '').length <= 20 || 'สูงสุด 20 ตัวอักษร',
      value => {
        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        return pattern.test(value) || 'รูปแบบ e-mail ไม่ถูกต้อง'
      },
    ],
  }),
  methods: {
    save(){
      this.formData.action = 'insert'
      if(this.$refs.form.validate()){
        this.bottonloading = true
        axios.post('/backend/action.php',this.formData).then(res => {
            if(res){
              this.formData.action = 'getall'
              this.tableloading = true
              axios.post('/backend/action.php',this.formData).then(res => {
                  if(res){
                    this.tableloading = false
                    let dummy = res.data.replace("int(200)\n", "");
                    this.rawData = JSON.parse(dummy)
                    this.rawData.map((obj) => {
                      obj.name = obj.fname+" "+obj.lname
                    })
                    this.tableloading = false
                    this.alertcolor = 'success'
                    this.alertword = "บันทึกข้อมูลเรียบร้อบ"
                    this.snackbar = true
                    this.bottonloading = false
                    this.$refs.form.reset()
                  }
                }
              ).catch(error=>{
                if(error){
                  this.tableloading = false
                  this.rawData = []
                  this.alertcolor = 'red'
                  this.alertword = 'การเชื่อมต่อกับฐานข้อมูลล้มเหลว\n'+error
                  this.snackbar = true
                }
                
              })
            }
          }
        ).catch(error=>{
          if(error){
            this.bottonloading = false
            this.alertcolor = 'red'
            this.alertword = 'การเพิ่มข้อมูลล้มเหลว\n'+error
            this.snackbar = true
          }
        })
      }
    },
    tedit(item){
      this.formData.fname = item.fname
      this.formData.lname = item.lname
      this.formData.sex = item.sex
      this.formData.birthdate = item.birthdate
      this.formData.tel = item.tel
      this.formData.email = item.email
      this.formData.address = item.address
      this.formData.id = item.id
      this.action_edit = true
    },
    tremove(item){
      this.removename = item.name
      this.i_remove = item.id
      this.dialog = true
    },
    edit(){
      this.formData.action = 'edit'
      if(this.$refs.form.validate()){
        this.bottonloading = true
        axios.post('/backend/action.php',this.formData).then(res => {
            if(res){
              this.formData.action = 'getall'
              this.tableloading = true
              axios.post('/backend/action.php',this.formData).then(res => {
                  if(res){
                    this.tableloading = false
                    let dummy = res.data.replace("int(200)\n", "");
                    this.rawData = JSON.parse(dummy)
                    this.rawData.map((obj) => {
                      obj.name = obj.fname+" "+obj.lname
                    })
                    this.tableloading = false
                    this.alertword = "แก้ไขข้อมูลเรียบร้อบ"
                    this.alertcolor = 'success'
                    this.snackbar = true
                    this.bottonloading = false
                    this.action_edit = false
                    this.$refs.form.reset()
                  }
                }
              ).catch(error=>{
                if(error){
                  this.tableloading = false
                  this.rawData = []
                  this.alertcolor = 'red'
                  this.alertword = 'การเชื่อมต่อกับฐานข้อมูลล้มเหลว\n'+error
                  this.snackbar = true
                }
              })
            }
          }
        ).catch(error=>{console.log(error);this.bottonloading = false})
      }
    },
    remove(){
      this.formData.action = 'delete'
      this.formData.id = this.i_remove
      axios.post('/backend/action.php',this.formData).then(res => {
          if(res){
            this.formData.action = 'getall'
            this.tableloading = true
            axios.post('/backend/action.php',this.formData).then(res => {
                if(res){
                  this.tableloading = false
                  let dummy = res.data.replace("int(200)\n", "");
                  this.rawData = JSON.parse(dummy)
                  this.rawData.map((obj) => {
                    obj.name = obj.fname+" "+obj.lname
                  })
                  this.tableloading = false
                  this.alertword = "ลบข้อมูลเรียบร้อบ"
                  this.alertcolor = 'success'
                  this.snackbar = true
                  this.dialog = false
                }
              }
            ).catch(error=>{
              if(error){
                this.tableloading = false
                this.rawData = []
                this.alertcolor = 'red'
                this.alertword = 'การเชื่อมต่อกับฐานข้อมูลล้มเหลว\n'+error
                this.snackbar = true
              }
            })
          }
        }
      ).catch(error=>{console.log(error);})
    },
    reset(){
      this.$refs.form.reset()
      this.action_edit = false
    }
  },
  created: function () {
    this.formData.action = 'getall'
    this.tableloading = true
    axios.post('/backend/action.php',this.formData).then(res => {
        if(res){
          this.tableloading = false
          let dummy = res.data.replace("int(200)\n", "");
          this.rawData = JSON.parse(dummy)
          this.rawData.map((obj) => {
            obj.name = obj.fname+" "+obj.lname
          })
        }
      }
    ).catch(error=>{
      if(error){
        this.tableloading = false
        this.rawData = []
        this.alertcolor = 'red'
        this.alertword = 'การเชื่อมต่อกับฐานข้อมูลล้มเหลว\n'+error
        this.snackbar = true
      }
      
    })
  }
};
</script>
