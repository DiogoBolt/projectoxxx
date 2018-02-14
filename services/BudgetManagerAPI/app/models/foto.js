const mongoose = require('mongoose');

const Schema = mongoose.Schema({
  foto: {
    type: String,
    required: true
  },

  girl_id: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'Girl'
  }
});

mongoose.model('Foto', Schema);
