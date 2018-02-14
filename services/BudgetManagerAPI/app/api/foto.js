const mongoose = require('mongoose');

const api = {};

api.store = (Girl, Foto, Token) => (req, res) => {
  if (Token) {
      console.log(req.query.girl_id );
    Girl.findOne({ _id: req.query.girl_id }, (error, girl) => {
      if (error) res.status(400).json(error);
        console.log(girl);
      if (girl) {
        const foto = new Foto({
          foto: req.body.foto,
          girl_id: req.query.girl_id
        });

        foto.save(error => {
          if (error) return res.status(400).json(error);
          res.status(200).json({ success: true, message: "Foto registration successful" });
        })
      } else {
        res.status(400).json({ success: false, message: "Invalid foto" })
      }
    })

  } else return res.status(403).send({ success: false, message: 'Unauthorized' });
}

api.getAll = (Girl, Foto, Token) => (req, res) => {
  if (Token) {
    Foto.find({ user_id: req.query.user_id }, (error, foto) => {
      if (error) return res.status(400).json(error);
      res.status(200).json(foto);
      return true;
    })
  } else return res.status(403).send({ success: false, message: 'Unauthorized' });
}

api.index = (Girl, Foto, Token) => (req, res) => {
  if (Token) {
    Girl.findOne({ _id: req.query.user_id }, (error, user) => {
      if (error) res.status(400).json(error);

      if (user) {
        Foto.findOne({ _id: req.query._id }, (error, foto) => {
          if (error) res.status(400).json(error);
          res.status(200).json(foto);
        })
      } else {
        res.status(400).json({ success: false, message: "Invalid foto" })
      }
    })

  } else return res.status(401).send({ success: false, message: 'Unauthorized' });
}

api.edit = (Girl, Foto, Token) => (req, res) => {
  if (Token) {
    Girl.findOne({ _id: req.query.user_id }, (error, user) => {
      if (error) res.status(400).json(error);

      if (user) {
        Foto.findOneAndUpdate({ _id: req.body._id }, req.body, (error, foto) => {
          if (error) res.status(400).json(error);
          res.status(200).json(foto);
        })
      } else {
        res.status(400).json({ success: false, message: "Invalid foto" })
      }
    })

  } else return res.status(401).send({ success: false, message: 'Unauthorized' });
}

api.remove = (Girl, Foto, Token) => (req, res) => {
  if (Token) {
    Girl.findOne({ _id: req.query.user_id }, (error, user) => {
      if (error) res.status(400).json(error);

      if (user) {
        Foto.remove({ _id: req.query._id }, (error, removed) => {
          if (error) res.status(400).json(error);
          res.status(200).json({ success: true, message: 'Removed successfully' });
        })
      } else {
        res.status(400).json({ success: false, message: "Invalid foto" })
      }
    })

  } else return res.status(401).send({ success: false, message: 'Unauthorized' });
}

module.exports = api;
