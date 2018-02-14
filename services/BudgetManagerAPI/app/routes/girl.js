const passport = require('passport'),
      config = require('@config'),
      models = require('@BudgetManager/app/setup');

module.exports = (app) => {
  const api = app.BudgetManagerAPI.app.api.girl;

  app.route('/api/v1/girl')
     .post( api.store(models.User, models.Girl, app.get('budgetsecret')))
     .get( api.getAll(models.User, models.Girl, app.get('budgetsecret')))
     .delete(passport.authenticate('jwt', config.session), api.remove(models.User, models.Girl, app.get('budgetsecret')))

  app.route('/api/v1/girl/single')
    .get(api.index(models.User, models.Client, app.get('budgetsecret')))
    .put(passport.authenticate('jwt', config.session), api.edit(models.User, models.Client, app.get('budgetsecret')))
}
