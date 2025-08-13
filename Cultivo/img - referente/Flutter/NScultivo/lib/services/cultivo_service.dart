import 'dart:convert';
import 'package:http/http.dart' as http;
import '../models/cultivo_model.dart';
import 'auth_service.dart';

class CultivoService {
  final String _baseUrl = 'http://127.0.0.1:8000/api';
  final AuthService _authService = AuthService();

  Future<List<Cultivo>> getCultivos() async {
    try {
      final token = await _authService.getToken();
      final response = await http.get(
        Uri.parse('$_baseUrl/cultivos'),
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer $token',
        },
      );

      if (response.statusCode == 200) {
        final List<dynamic> cultivosJson = json.decode(response.body);
        return cultivosJson.map((json) => Cultivo.fromJson(json)).toList();
      }
      throw Exception('Error al cargar los cultivos');
    } catch (e) {
      throw Exception('Error de conexión: $e');
    }
  }

  Future<Cultivo> createCultivo(Cultivo cultivo) async {
    try {
      final token = await _authService.getToken();
      final response = await http.post(
        Uri.parse('$_baseUrl/cultivos'),
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer $token',
        },
        body: json.encode(cultivo.toJson()),
      );

      if (response.statusCode == 201) {
        return Cultivo.fromJson(json.decode(response.body));
      }
      throw Exception('Error al crear el cultivo');
    } catch (e) {
      throw Exception('Error de conexión: $e');
    }
  }

  Future<Cultivo> updateCultivo(int id, Cultivo cultivo) async {
    try {
      final token = await _authService.getToken();
      final response = await http.put(
        Uri.parse('$_baseUrl/cultivos/$id'),
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer $token',
        },
        body: json.encode(cultivo.toJson()),
      );

      if (response.statusCode == 200) {
        return Cultivo.fromJson(json.decode(response.body));
      }
      throw Exception('Error al actualizar el cultivo');
    } catch (e) {
      throw Exception('Error de conexión: $e');
    }
  }

  Future<void> deleteCultivo(int id) async {
    try {
      final token = await _authService.getToken();
      final response = await http.delete(
        Uri.parse('$_baseUrl/cultivos/$id'),
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer $token',
        },
      );

      if (response.statusCode != 200 && response.statusCode != 204) {
        throw Exception('Error al eliminar el cultivo');
      }
    } catch (e) {
      throw Exception('Error de conexión: $e');
    }
  }
}