const mongoose = require('mongoose');

const api = {};

api.store = (User, Girl, Token) => (req, res) => {
  if (Token) {
    User.findOne({ _id: req.query.user_id }, (error, user) => {
      if (error) res.status(400).json(error);

      if (user) {
        const girl = new Girl({
          user_id: req.query.user_id,
          name: req.body.name,
          email: req.body.email,
          phone: req.body.phone,
          girlType: req.body.girltype
        });

        girl.save(error => {
          if (error) return res.status(400).json(error);
          res.status(200).json({ success: true, message: "Girl registration successful" });
        })
      } else {
        res.status(400).json({ success: false, message: "Invalid girl" })
      }
    })

  } else return res.status(403).send({ success: false, message: 'Unauthorized' });
}

api.getAll = (User, Girl, Token) => (req, res) => {
  if (Token) {
    Girl.find({ }).populate('fotos')
    .exec(function (error, girl) {
        console.log(girl);
        if (error) return res.status(400).json(error);
        res.status(200).json(girl);
        return true;
      })
  } else return res.status(403).send({ success: false, message: 'Unauthorized' });
}

api.index = (User, Girl, Token) => (req, res) => {
  if (Token) {
    User.findOne({ _id: req.query.user_id }, (error, user) => {
      if (error) res.status(400).json(error);

      if (user) {
        Girl.findOne({ _id: req.query._id }, (error, girl) => {
          if (error) res.status(400).json(error);
          res.status(200).json(girl);
        })
      } else {
        res.status(400).json({ success: false, message: "Invalid girl" })
      }
    }).populate('Fotos')

  } else return res.status(401).send({ success: false, message: 'Unauthorized' });
}

api.edit = (User, Girl, Token) => (req, res) => {
  if (Token) {
    User.findOne({ _id: req.query.user_id }, (error, user) => {
      if (error) res.status(400).json(error);

      if (user) {
        Girl.findOneAndUpdate({ _id: req.body._id }, req.body, (error, girl) => {
          if (error) res.status(400).json(error);
          res.status(200).json(girl);
        })
      } else {
        res.status(400).json({ success: false, message: "Invalid girl" })
      }
    })

  } else return res.status(401).send({ success: false, message: 'Unauthorized' });
}

api.remove = (User, Girl, Token) => (req, res) => {
  if (Token) {
    User.findOne({ _id: req.query.user_id }, (error, user) => {
      if (error) res.status(400).json(error);

      if (user) {
        Girl.remove({ _id: req.query._id }, (error, removed) => {
          if (error) res.status(400).json(error);
          res.status(200).json({ success: true, message: 'Removed successfully' });
        })
      } else {
        res.status(400).json({ success: false, message: "Invalid girl" })
      }
    })

  } else return res.status(401).send({ success: false, message: 'Unauthorized' });
}

module.exports = api;
