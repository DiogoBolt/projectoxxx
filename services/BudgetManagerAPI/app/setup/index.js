const mongoose = require('mongoose'),
      UserModel = require('@BudgetManagerModels/user'),
      FotoModel = require('@BudgetManagerModels/foto'),
      GirlModel = require('@BudgetManagerModels/girl');

const models = {
  User: mongoose.model('User'),
  Foto: mongoose.model('Foto'),
  Girl: mongoose.model('Girl')
}

module.exports = models;
