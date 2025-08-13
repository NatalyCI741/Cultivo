import 'package:flutter/material.dart';
import '../models/cultivo_model.dart';
import '../services/cultivo_service.dart';

class CultivoProvider extends ChangeNotifier {
  final CultivoService _cultivoService = CultivoService();
  List<Cultivo> _cultivos = [];
  bool _isLoading = false;
  String _errorMessage = '';

  List<Cultivo> get cultivos => _cultivos;
  bool get isLoading => _isLoading;
  String get errorMessage => _errorMessage;

  Future<void> loadCultivos() async {
    _isLoading = true;
    _errorMessage = '';
    notifyListeners();

    try {
      _cultivos = await _cultivoService.getCultivos();
      _errorMessage = '';
    } catch (e) {
      _errorMessage = e.toString();
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

  Future<bool> createCultivo(Cultivo cultivo) async {
    _isLoading = true;
    _errorMessage = '';
    notifyListeners();

    try {
      final newCultivo = await _cultivoService.createCultivo(cultivo);
      _cultivos.add(newCultivo);
      _errorMessage = '';
      notifyListeners();
      return true;
    } catch (e) {
      _errorMessage = e.toString();
      notifyListeners();
      return false;
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

  Future<bool> updateCultivo(int id, Cultivo cultivo) async {
    _isLoading = true;
    _errorMessage = '';
    notifyListeners();

    try {
      final updatedCultivo = await _cultivoService.updateCultivo(id, cultivo);
      final index = _cultivos.indexWhere((c) => c.id == id);
      if (index != -1) {
        _cultivos[index] = updatedCultivo;
      }
      _errorMessage = '';
      notifyListeners();
      return true;
    } catch (e) {
      _errorMessage = e.toString();
      notifyListeners();
      return false;
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

  Future<bool> deleteCultivo(int id) async {
    _isLoading = true;
    _errorMessage = '';
    notifyListeners();

    try {
      await _cultivoService.deleteCultivo(id);
      _cultivos.removeWhere((c) => c.id == id);
      _errorMessage = '';
      notifyListeners();
      return true;
    } catch (e) {
      _errorMessage = e.toString();
      notifyListeners();
      return false;
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }
} 