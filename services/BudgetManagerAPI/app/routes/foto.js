const passport = require('passport'),
      config = require('@config'),
      models = require('@BudgetManager/app/setup');

module.exports = (app) => {
  const api = app.BudgetManagerAPI.app.api.foto;

  app.route('/api/v1/foto')
     .post( api.store(models.Girl, models.Foto, app.get('budgetsecret')))
     .get( api.getAll(models.Girl, models.Foto, app.get('budgetsecret')))
     .delete(passport.authenticate('jwt', config.session), api.remove(models.User, models.Girl, app.get('budgetsecret')))

  app.route('/api/v1/foto/single')
    .get(api.index(models.Girl, models.Foto, app.get('budgetsecret')))
    .put(passport.authenticate('jwt', config.session), api.edit(models.User, models.Client, app.get('budgetsecret')))
}
