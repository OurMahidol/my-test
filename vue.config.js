module.exports = {
  transpileDependencies: [
    'vuetify'
  ],
  devServer: {
    proxy: {
      '^/backend/': {
        target: 'http://localhost',
        changeOrigin: true
      }
    }
  }
}
